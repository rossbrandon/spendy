<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use Auth;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->session()->get('date')) {
            $request->session()->put('date', strtotime(now()));
        }

        $date = $request->session()->get('date');
        $budgets = Budget::where('user_id', Auth::id())->get();

        return view('budgets.index')->with('navBudgets', $budgets->take(5))
            ->with('budgets', $budgets)
            ->with('date', $date);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = $request->session()->get('date');
        $budgets = Budget::where('user_id', Auth::id())->get();
        return view('budgets.create')->with('navBudgets', $budgets->take(5))
            ->with('date', $date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required|date',
            'amount' => 'required|between:0,99.99'
        ]);

        $date = date('Y-m-01', strtotime($request->date));

        Budget::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'date' => $date,
            'amount' => $request->amount
        ]);

        return redirect()->route('budgets');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $date = $request->session()->get('date');
        $budget = Budget::find($id);
        $budgets = Budget::where('user_id', Auth::id())->get();

        return view('budgets.edit')->with('budget', $budget)
            ->with('navBudgets', $budgets->take(5))
            ->with('date', $date);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required|date',
            'amount' => 'required|between:0,99.99'
        ]);

        $budget = Budget::find($id);
        $budget->name = $request->name;
        $budget->date = date('Y-m-01', strtotime($request->date));
        $budget->amount = $request->amount;
        $budget->save();

        return redirect()->route('budgets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $budget = Budget::find($id);
        $budget->delete();

        return redirect()->back();
    }
}

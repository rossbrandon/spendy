<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Budget;
use Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->session()->get('date');
        return view('expenses.index')->with('expenses', Expense::all())
            ->with('date', $date);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = $request->session()->get('date');
        return view('expenses.create')->with('budgets', Budget::all())
            ->with('navBudgets', Budget::take(3)->get())
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
            'budget_id' => 'required',
            'place' => 'required',
            'date' => 'required|date',
            'price' => 'required|between:0,99.99',
            'reason' => 'max:255'
        ]);

        $expense = Expense::create([
            'user_id' => Auth::id(),
            'budget_id' => $request->budget_id,
            'place' => $request->place,
            'date' => $request->date,
            'price' => $request->price,
            'reason' => $request->reason
        ]);

        return redirect()->route('expense.show', ['id' => $expense->budget->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $date = $request->session()->get('date');
        $budget = 100.00;
        $firstDayOfMonth = date('Y-m-01', $date);
        $lastDayOfMonth = date('Y-m-t', $date);
        $expenses = Expense::where('budget_id', $id)
            ->where('date', '>=', $firstDayOfMonth)
            ->where('date', '<=', $lastDayOfMonth)
            ->orderBy('date', 'asc')
            ->get();
        $spent = $expenses->sum('price');
        $remaining = $budget - $spent;
        return view('expenses.index')->with('expenses', $expenses)
            ->with('navBudgets', Budget::take(3)->get())
            ->with('currentBudget', Budget::find($id))
            ->with('date', $date)
            ->with('budget', $budget)
            ->with('spent', $spent)
            ->with('remaining', $remaining);
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
        $expense = Expense::find($id);

        return view('expenses.edit')->with('expense', $expense)
            ->with('budgets', Budget::all())
            ->with('navBudgets', Budget::take(3)->get())
            ->with('currentBudget', Budget::find($id))
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
            'budget_id' => 'required',
            'place' => 'required',
            'date' => 'required|date',
            'price' => 'required|between:0,99.99',
            'reason' => 'max:255'
        ]);

        $expense = Expense::find($id);
        $expense->budget_id = $request->budget_id;
        $expense->place = $request->place;
        $expense->date = $request->date;
        $expense->price = $request->price;
        $expense->reason = $request->reason;
        $expense->save();

        return redirect()->route('expense.show', ['id' => $expense->budget->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return redirect()->back();
    }

    /**
     * Go to previous month
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function prev(Request $request, int $id)
    {
        $date = $request->session()->pull('date');
        $prevMonth = date('Y-m-01', strtotime('-1 month', $date));
        $request->session()->put('date', strtotime($prevMonth));

        return redirect()->route('expense.show', ['id' => $id]);
    }

    /**
     * Go to next month
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function next(Request $request, int $id)
    {
        $date = $request->session()->pull('date');
        $prevMonth = date('Y-m-01', strtotime('+1 month', $date));
        $request->session()->put('date', strtotime($prevMonth));

        return redirect()->route('expense.show', ['id' => $id]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Budget;
use App\Expense;
use Validator;
use Auth;

class BudgetsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->get();
        return $this->sendResponse($budgets, Response::HTTP_OK);
    }

    /**
     * Get all expenses for a budget
     *
     * @param int $id
     * @param string $date
     * @return \Illuminate\Http\Response
     */
    public function expenses($id, $date = null)
    {
        $date = !$date ? strtotime(now()) : strtotime($date);
        $firstDayOfMonth = date('Y-m-01', $date);
        $lastDayOfMonth = date('Y-m-t', $date);
        $budget = Budget::find($id);
        $data = null;
        if ($budget->user_id == Auth::id()) {
            $data = Expense::where('budget_id', $id)
                ->where('date', '>=', $firstDayOfMonth)
                ->where('date', '<=', $lastDayOfMonth)
                ->get();
        }

        return $this->sendResponse($data, Response::HTTP_OK);
    }

    /**
     * Return aggregate data for user's budgets
     *
     * @param string $date
     * @return \Illuminate\Http\Response
     */
    public function aggregate($date)
    {
        $date = strtotime($date);
        $firstDayOfMonth = date('Y-m-01', $date);
        $lastDayOfMonth = date('Y-m-t', $date);
        $budgets = Budget::where('user_id', Auth::id())->get();

        $totalBudget = 0;
        $totalSpent = 0;
        foreach ($budgets as $budget) {
            $expenses = Expense::where('budget_id', $budget->id)
                ->where('date', '>=', $firstDayOfMonth)
                ->where('date', '<=', $lastDayOfMonth)
                ->get();
            $totalSpent += $expenses->sum('price');
            $totalBudget += $budget->amount;
        }
        $totalRemaining = $totalBudget - $totalSpent;
        $data = [
            'total-budget' => $totalBudget,
            'total-spent' => $totalSpent,
            'total-remaining' => $totalRemaining
        ];

        return $this->sendResponse($data, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'date' => 'required|date',
                'amount' => 'required|between:0,99.99'
            ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Failed', $validator->errors(), 400);
        }

        $date = date('Y-m-01', strtotime($request->date));

        $budget = Budget::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'date' => $date,
            'amount' => $request->amount
        ]);

        return $this->sendResponse($budget, 'Budget created');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $param
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
        if (\DateTime::createFromFormat('Y-m-d', $param) !== false) {
            $firstDayOfMonth = date('Y-m-01', strtotime($param));
            $lastDayOfMonth = date('Y-m-t', strtotime($param));
            $data = Budget::where('user_id', Auth::id())
                ->where('date', '>=', $firstDayOfMonth)
                ->where('date', '<=', $lastDayOfMonth)
                ->get();
        } else {
            $data = Budget::find($param);
        }

        return $this->sendResponse($data, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'date' => 'required|date',
                'amount' => 'required|between:0,99.99'
            ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $budget = Budget::find($id);
        if ($budget->user_id == Auth::id()) {
            $budget->name = $request->name;
            $budget->date = date('Y-m-01', strtotime($request->date));
            $budget->amount = $request->amount;
            $budget->save();
        } else {
            return $this->sendError('This is not your budget to alter!', [], Response::HTTP_FORBIDDEN);
        }

        return $this->sendResponse($budget, 'Budget updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $budget = Budget::find($id);
        if ($budget->user_id == Auth::id()) {
            $budget->delete();
        } else {
            return $this->sendError('This is not your budget to delete!', [], Response::HTTP_FORBIDDEN);
        }

        return $this->sendResponse($budget, 'Resource deleted');
    }
}

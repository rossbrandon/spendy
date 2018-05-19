<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Expense;
use App\Budget;
use Validator;
use Auth;

class ExpensesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetIds = Budget::where('user_id', Auth::id())->select('id')->get();
        $expenses = Expense::whereIn('budget_id', $budgetIds)->get();
        return $this->sendResponse($expenses, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'budget_id' => 'required',
            'place' => 'required',
            'date' => 'required|date',
            'price' => 'required|between:0,99.99',
            'reason' => 'max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Failed', $validator->errors(), 400);
        }

        $expense = Expense::create([
            'budget_id' => $request->budget_id,
            'place' => $request->place,
            'date' => $request->date,
            'price' => $request->price,
            'reason' => $request->reason
        ]);

        return $this->sendResponse($expense, 'Expense created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sendResponse(Expense::find($id), Response::HTTP_OK);
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
        $validator = Validator::make($request->all(), [
            'budget_id' => 'required',
            'place' => 'required',
            'date' => 'required|date',
            'price' => 'required|between:0,99.99',
            'reason' => 'max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $expense = Expense::find($id);
        if ($expense->budget->user_id == Auth::id()) {
            $expense->budget_id = $request->budget_id;
            $expense->place = $request->place;
            $expense->date = $request->date;
            $expense->price = $request->price;
            $expense->reason = $request->reason;
            $expense->save();
        } else {
            return $this->sendError('This is not your expense to alter!', [], Response::HTTP_FORBIDDEN);
        }

        return $this->sendResponse($expense, 'Expense updated');
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
        if ($expense->budget->user_id == Auth::id()) {
            $expense->delete();
        } else {
            return $this->sendError('This is not your expense to delete!', [], Response::HTTP_FORBIDDEN);
        }

        return $this->sendResponse($expense, 'Expense deleted');
    }
}

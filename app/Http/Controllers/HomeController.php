<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\Expense;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the landing page.
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
        return view('index')->with('navBudgets', Budget::take(3)->get())
            ->with('date', $date);
    }

    /**
     * Load the application dashboard
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        if (!$request->session()->get('date')) {
            $request->session()->put('date', strtotime(now()));
        }

        $date = $request->session()->get('date');
        $firstDayOfMonth = date('Y-m-01', $date);
        $lastDayOfMonth = date('Y-m-t', $date);
        $budgets = Budget::where('user_id', Auth::id())
            ->where('date', '>=', $firstDayOfMonth)
            ->where('date', '<=', $lastDayOfMonth)
            ->get();

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

        return view('dashboard')->with('budgets', $budgets)
            ->with('navBudgets', $budgets->take(3))
            ->with('date', $date)
            ->with('totalBudget', $totalBudget)
            ->with('totalSpent', $totalSpent)
            ->with('totalRemaining', $totalRemaining);
    }

    /**
     * Go to previous month
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function prev(Request $request)
    {
        $date = $request->session()->pull('date');
        $prevMonth = date('Y-m-01', strtotime('-1 month', $date));
        $request->session()->put('date', strtotime($prevMonth));

        return redirect()->route('dashboard');
    }

    /**
     * Go to next month
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function next(Request $request)
    {
        $date = $request->session()->pull('date');
        $prevMonth = date('Y-m-01', strtotime('+1 month', $date));
        $request->session()->put('date', strtotime($prevMonth));

        return redirect()->route('dashboard');
    }
}

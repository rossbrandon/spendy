<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
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
        return view('index')->with('categories', Category::take(3)->get())
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
        $budget = 1000.00;
        $firstDayOfMonth = date('Y-m-01', $date);
        $lastDayOfMonth = date('Y-m-t', $date);
        $expenses = Expense::where('user_id', Auth::id())
            ->where('date', '>=', $firstDayOfMonth)
            ->where('date', '<=', $lastDayOfMonth)
            ->get();
        $spent = $expenses->sum('price');
        $remaining = $budget - $spent;

        return view('dashboard')->with('expenses', $expenses)
            ->with('categories', Category::take(3)->get())
            ->with('date', $date)
            ->with('budget', $budget)
            ->with('spent', $spent)
            ->with('remaining', $remaining);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Load the application dashboard
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Load the dining spending tracker
     */
    public function dining()
    {
        return view('dining.index');
    }

    /**
     * Edit a dining out entry
     */
    public function edit()
    {
        return view('dining.edit');
    }
}

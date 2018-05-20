<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use Auth;

class UsersController extends Controller
{
    /**
     * Show the profile page.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->session()->get('date');
        $budgets = Budget::where('user_id', Auth::id())->get();
        return view('users.profile')
            ->with('user', Auth::user())
            ->with('date', $date)
            ->with('navBudgets', $budgets->take(5));
    }

    /**
     * Edit the user's profile
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Auth::user();

        if ($request->has('password') && $request->password != null && $request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dashboard');
    }
}

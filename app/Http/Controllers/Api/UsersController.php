<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => User::all(), 'status' => Response::HTTP_OK]);
    }

    /**
     * Return the current user's information
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return response()->json(['data' => User::find(Auth::id()), 'status' => Response::HTTP_OK]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => User::find($id), 'status' => Response::HTTP_OK]);
    }
}

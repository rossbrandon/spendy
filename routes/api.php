<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user',
    function (Request $request) {
        return $request->user();
    });

Route::middleware('auth:api')->group(function () {
    Route::resource('users', 'Api\UsersController');
    Route::resource('budgets', 'Api\BudgetsController');
    Route::resource('expenses', 'Api\ExpensesController');

    Route::get('/budgets/{id}/expenses/{date?}', 'Api\BudgetsController@expenses');
    Route::get('/budgets/{date}/aggregate', 'Api\BudgetsController@aggregate');
    Route::get('/me', 'Api\UsersController@me');
});

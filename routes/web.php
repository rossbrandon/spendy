<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/',
    [
        'uses' => 'HomeController@index',
        'as' => 'index'
    ]);

Auth::routes();

Route::group(['middleware' => 'auth'],
    function () {

        Route::get('/profile',
            [
                'uses' => 'UsersController@index',
                'as' => 'users.profile'
            ]);

        Route::post('/profile/update',
            [
                'uses' => 'UsersController@update',
                'as' => 'users.profile.update'
            ]);

        Route::get('/dashboard',
            [
                'uses' => 'HomeController@dashboard',
                'as' => 'dashboard'
            ]);

        Route::get('/prev',
            [
                'uses' => 'HomeController@prev',
                'as' => 'prev'
            ]);

        Route::get('/next',
            [
                'uses' => 'HomeController@next',
                'as' => 'next'
            ]);

        Route::get('/expense/show/{name}',
            [
                'uses' => 'ExpensesController@show',
                'as' => 'expense.show'
            ]);

        Route::get('/expense/prev/{name}',
            [
                'uses' => 'ExpensesController@prev',
                'as' => 'expense.prev'
            ]);

        Route::get('/expense/next/{name}',
            [
                'uses' => 'ExpensesController@next',
                'as' => 'expense.next'
            ]);

        Route::get('/expense/create/{budgetId}',
            [
                'uses' => 'ExpensesController@create',
                'as' => 'expense.create'
            ]);

        Route::post('/expense/store',
            [
                'uses' => 'ExpensesController@store',
                'as' => 'expense.store'
            ]);

        Route::get('/expense/edit/{id}',
            [
                'uses' => 'ExpensesController@edit',
                'as' => 'expense.edit'
            ]);

        Route::post('/expense/update/{id}',
            [
                'uses' => 'ExpensesController@update',
                'as' => 'expense.update'
            ]);

        Route::get('/expense/delete/{id}',
            [
                'uses' => 'ExpensesController@destroy',
                'as' => 'expense.delete'
            ]);

        Route::get('/budgets',
            [
                'uses' => 'BudgetsController@index',
                'as' => 'budgets'
            ]);

        Route::get('/budget/create',
            [
                'uses' => 'BudgetsController@create',
                'as' => 'budget.create'
            ]);

        Route::post('/budget/store',
            [
                'uses' => 'BudgetsController@store',
                'as' => 'budget.store'
            ]);

        Route::get('/budget/edit/{id}',
            [
                'uses' => 'BudgetsController@edit',
                'as' => 'budget.edit'
            ]);

        Route::post('/budget/update/{id}',
            [
                'uses' => 'BudgetsController@update',
                'as' => 'budget.update'
            ]);

        Route::get('/budget/delete/{id}',
            [
                'uses' => 'BudgetsController@destroy',
                'as' => 'budget.delete'
            ]);
    }
);

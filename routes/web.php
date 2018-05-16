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

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'index'
]);

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/dashboard', [
        'uses' => 'HomeController@dashboard',
        'as' => 'dashboard'
    ]);

    Route::get('/prev', [
        'uses' => 'HomeController@prev',
        'as' => 'prev'
    ]);

    Route::get('/next', [
        'uses' => 'HomeController@next',
        'as' => 'next'
    ]);

    Route::get('/expense/show/{id}', [
        'uses' => 'ExpensesController@show',
        'as' => 'expense.show'
    ]);

    Route::get('/expense/prev/{id}', [
        'uses' => 'ExpensesController@prev',
        'as' => 'expense.prev'
    ]);

    Route::get('/expense/next/{id}', [
        'uses' => 'ExpensesController@next',
        'as' => 'expense.next'
    ]);

    Route::get('/expense/create', [
        'uses' => 'ExpensesController@create',
        'as' => 'expense.create'
    ]);

    Route::post('/expense/store', [
        'uses' => 'ExpensesController@store',
        'as' => 'expense.store'
    ]);

    Route::get('/expense/edit/{id}', [
        'uses' => 'ExpensesController@edit',
        'as' => 'expense.edit'
    ]);

    Route::post('/expense/update/{id}', [
        'uses' => 'ExpensesController@update',
        'as' => 'expense.update'
    ]);

    Route::get('/expense/delete/{id}', [
        'uses' => 'ExpensesController@destroy',
        'as' => 'expense.delete'
    ]);
});

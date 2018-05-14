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

    Route::get('/dining', [
        'uses' => 'ExpensesController@index',
        'as' => 'dining'
    ]);

    Route::get('/edit', [
        'uses' => 'HomeController@edit',
        'as' => 'edit'
    ]);

});

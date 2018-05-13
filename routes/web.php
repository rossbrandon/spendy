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

Route::get('/dining', [
    'uses' => 'HomeController@dining',
    'as' => 'dining'
]);

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

});

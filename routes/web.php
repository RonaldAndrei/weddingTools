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

//routes default
Auth::routes();
Route::get('/', function () { return view('auth.login'); });
Route::get('/home', 'HomeController@index')->name('home');

//routes user
Route::get('/usernew', 'UserController@retornaViewUserNew')->name('userView');
Route::post('/usernew', 'UserController@validator')->name('userNew');

//routes truco
//routes confirmacao
//routes info

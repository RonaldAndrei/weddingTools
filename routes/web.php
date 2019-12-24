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
Route::get('/', function () {
    if (Auth::check()) {
        return view('home');
    } else {
        return view('auth.login');
    }
});
Route::get('/home', 'HomeController@index')->name('home');

//routes user
Route::get('/userhome', 'UserController@retornaViewUserHome')->name('userView');
Route::get('/usernew', 'UserController@retornaViewUserNew')->name('userNew');

Route::post('/usernew', 'UserController@validator')->name('userNew');
Route::post('/userdelete', 'UserController@validator')->name('userDel');

//routes convidados
Route::get('/convidadonew', 'ConvidadoController@retornaViewConvidadoNew')->name('convidadoNew');
Route::get('/{convidadohome}', 'ConvidadoController@retornaViewConvidadoHome')->name('convidadoView');
Route::get('/{convidadoconfirma}', 'ConvidadoController@retornaViewConvidadoHome')->name('convidadoView');

Route::post('/convidadonew', 'ConvidadoController@validator')->name('convidadoNew');
Route::post('/convidadodelete', 'ConvidadoController@validator')->name('convidadoDel');


//routes truco
//routes confirmacao
//routes info

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
        return redirect('/convidadoconfirma/{confirma}');
    } else {
        return view('auth.login');
    }
});

//routes info
Route::get('/home', 'HomeController@index')->name('home');

//routes user get
Route::get('/userhome', 'UserController@retornaViewUserHome')->name('userView');
Route::get('/usernew', 'UserController@retornaViewUserNew')->name('userNew');
//routes convidados get
Route::get('/convidadohome/{home}', 'ConvidadoController@retornaViewConvidadoHome')->name('convidadoView');
Route::get('/convidadonew', 'ConvidadoController@retornaViewConvidadoNew')->name('convidadoNew');
//routes confirmacao get
Route::get('/convidadoconfirma/{confirma}', 'ConvidadoController@retornaViewConvidadoHome')->name('convidadoView');
//routes truco get
Route::get('/truconew', 'TrucoController@retornaViewTrucoNew')->name('trucoNew');

//routes user post
Route::post('/user/{new}', 'UserController@validator')->name('userNew');
Route::post('/user/{delete}', 'UserController@validator')->name('userDel');
//routes convidados post
Route::post('/convidado/{new}', 'ConvidadoController@validator')->name('convidadoNew');
Route::post('/convidado/{delete}', 'ConvidadoController@validator')->name('convidadoDel');
//routes confirmacao post
Route::post('/convidado/{presente}', 'ConvidadoController@validator')->name('convidadoPresente');
Route::post('/convidado/{ausente}', 'ConvidadoController@validator')->name('convidadoAusente');
//routes truco post
Route::post('/truco/{new}', 'TrucoController@validator')->name('trucoNew');

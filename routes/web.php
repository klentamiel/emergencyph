<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/edit/user', 'UserController@edit')->name('user.edit');

Route::post('/edit/user', 'UserController@update')->name('user.update');

Route::get('/change/password', 'UserController@passwordEdit')->name('password.edit');

Route::post('/change/password', 'UserController@passwordUpdate')->name('password.update');
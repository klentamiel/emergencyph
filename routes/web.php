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

Route::get('/edit/user', 'UserController@editProfile')->name('user.edit');
Route::post('/edit/user', 'UserController@updateProfile')->name('user.update');

Route::get('/change/password', 'UserController@passwordEdit')->name('password.edit');
Route::post('/change/password', 'UserController@passwordUpdate')->name('password.update');

Route::get('/register/officer', 'PoliceController@registerOfficer')->name('register.officer');
Route::post('/register/officer', 'PoliceController@registerSave')->name('register.officer.save');

Route::get('/register/ambulance', 'HospitalController@registerAmbulance')->name('register.ambulance');
Route::post('/register/ambulance', 'HospitalController@registerSave')->name('register.ambulance.save');

Route::get('/register/fireman', 'FireController@registerFireman')->name('register.fireman');
Route::post('/register/fireman', 'FireController@registerSave')->name('register.fireman.save');

Route::get('/register/station', 'AdminController@registerStation')->name('register.station');
Route::post('/register/station', 'AdminController@registerSave')->name('register.station.save');

Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['show', 'create', 'store']]);
Route::post('/admin/users', 'Admin\UsersController@search')->name('admin.search');
Route::get('/verify/users', 'Admin\UsersController@pendingVerifications')->name('admin.pending');
Route::post('/verify/users', 'Admin\UsersController@allow')->name('admin.allow');
Route::get('/verify/users/{user}/profile', 'Admin\UsersController@viewProfile')->name('admin.profile');

Route::resource('/police/officers', 'Police\UsersController', ['except' => ['show', 'create', 'store']]);
Route::post('/police/officers', 'Police\UsersController@search')->name('police.search');

Route::resource('/hospital/ambulances', 'Hospital\UsersController', ['except' => ['show', 'create', 'store']]);
Route::post('/hospital/ambulances', 'Hospital\UsersController@search')->name('hospital.search');

Route::resource('/fire/firemans', 'Fire\UsersController', ['except' => ['show', 'create', 'store']]);
Route::post('/fire/firemans', 'Fire\UsersController@search')->name('fire.search');

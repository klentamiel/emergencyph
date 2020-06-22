<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/register',[
    'as' => 'register.register',
    'uses' => 'Api\Auth\RegisterController@register',
]);

Route::post('/login',[
    'as' => 'login.login',
    'uses' => 'Api\Auth\LoginController@login',
]);

Route::get('/user/getcontacts',[
    'as' => 'getcontacts.getcontacts',
    'uses' => 'Api\ContactsController@index',
]);

Route::get('/user/getcontactbyid',[
    'as' => 'getcontactbyid.getcontactbyid',
    'uses' => 'Api\ContactsController@getcontactbyid',
]);


Route::post('/user/createcontact',[
    'as' => 'usercontact.createcontact',
    'uses' => 'Api\ContactsController@create',
]);

Route::post('/user/updatecontact',[
    'as' => 'updatecontact.updatecontact',
    'uses' => 'Api\ContactsController@update',
]);


Route::post('/user/deletecontact',[
    'as' => 'deletecontact.deletecontact',
    'uses' => 'Api\ContactsController@destroy',
]);


Route::get('/user/getprofile',[
    'as' => 'getprofile.getprofile',
    'uses' => 'Api\UserProfileController@getProfile',
]);

Route::post('/user/savepersonalprofile',[
    'as' => 'savepersonalprofile.savepersonalprofile',
    'uses' => 'Api\UserProfileController@savepersonalprofile',
]);

Route::post('/user/saveaddress',[
    'as' => 'saveaddress.saveaddress',
    'uses' => 'Api\UserProfileController@saveaddress',
]);

Route::post('/user/saveidentifications',[
    'as' => 'saveidentifications.saveidentifications',
    'uses' => 'Api\UserProfileController@saveidentifications',
]);

Route::post('/user/updateprofile',[
    'as' => 'updateprofile.updateprofile',
    'uses' => 'Api\UserProfileController@updateprofile
    ',
]);

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/user/login', 'UserController@getLogin');
Route::post('/user/login', 'UserController@postLogin');
Route::get('/user/logout', 'UserController@getLogout');

Route::get('/user/register', 'UserController@getRegister');
Route::post('/user/register', 'UserController@postRegister');

Route::get('/test-mail', 'UserController@getTestMail');


Route::group(['middleware' => ['auth', 'accountConfirmation']], function () {
    Route::get('/user/profile', 'UserController@getProfile');
    Route::post('/user/profile', 'UserController@postEditProfile');
    Route::post('/user/profile/change-password', 'UserController@postChangePassword');

    Route::get('/user/confirm', 'UserController@getConfirm');
    Route::get('/user/confirm/{confirmation_token}', 'UserController@getConfirmationAccount');

    Route::get('/messages', 'MessageController@showMessages');
    Route::post('/messages/create', 'MessageController@createMessage');
    Route::get('/messages/edit/{id}', 'MessageController@getMessage')->middleware('message');
    Route::post('/messages/edit/{id}', 'MessageController@postEditMessage')->middleware('message');
    Route::get('/messages/delete/{id}', 'MessageController@deleteMessage')->middleware('message');
});
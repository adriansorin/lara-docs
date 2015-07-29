<?php
use Illuminate\Http\Request;

Route::get('/', 'HomeController@index');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);
Route::get('document/create/{id?}', ['middleware' => 'auth', 'uses' => 'DocumentController@create']);
Route::post('document/add', ['middleware' => 'auth', 'uses' => 'DocumentController@add']);
Route::post('document/update/{id}', ['middleware' => 'auth', 'uses' => 'DocumentController@update']);
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'login', 'uses' => 'Web\HomeController@welcome']);


//Auth::routes();
// Authentication Routes...
// Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Web\Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Web\Auth\LoginController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Web\Auth\LoginController@logout']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Web\Auth\LoginController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'register', 'uses' => 'Web\Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => 'register.post', 'uses' => 'Web\Auth\RegisterController@register']);
Route::get('register/confirm/{token}', ['as' => 'register.confirm', 'uses' => 'Web\Auth\RegisterController@confirm']);

// Password Reset Routes...
Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Web\Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Web\Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Web\Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Web\Auth\ResetPasswordController@reset']);

Route::get('/home', ['as' => 'home', 'uses' => 'Web\HomeController@index']);

<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'admin.welcome', 'uses' => 'Admin\HomeController@welcome']);


//Auth::routes();
// Authentication Routes...
// Login Routes...
Route::get('login', ['as' => 'admin.login', 'uses' => 'Admin\Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'admin.login.post', 'uses' => 'Admin\Auth\LoginController@login']);
Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\Auth\LoginController@logout']);
Route::post('logout', ['as' => 'admin.logout', 'uses' => 'Admin\Auth\LoginController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'admin.register', 'uses' => 'Admin\Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => 'admin.register.post', 'uses' => 'Admin\Auth\RegisterController@register']);
Route::get('register/confirm/{token}', ['as' => 'admin.register.confirm', 'uses' => 'Admin\Auth\RegisterController@confirm']);

// Password Reset Routes...
Route::get('password/reset', ['as' => 'admin.password.reset', 'uses' => 'Admin\Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'admin.password.email', 'uses' => 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'admin.password.reset.token', 'uses' => 'Admin\Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'admin.password.reset.post', 'uses' => 'Admin\Auth\ResetPasswordController@reset']);

Route::get('home', ['as' => 'admin.home', 'uses' => 'Admin\HomeController@index']);

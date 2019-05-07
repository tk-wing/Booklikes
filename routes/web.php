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

Route::resource('/home', 'HomeController');
Route::get('/signup', 'Auth\SignupController@create');
Route::post('/signup', 'Auth\SignupController@store');
Route::get('/login', 'Auth\AuthController@index');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('/logout', 'Auth\AuthController@logout');

Route::resource('/profile', 'ProfileController');
Route::resource('/book', 'BookController');
Route::resource('/feed', 'FeedController');

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

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/profile', 'ProfileController');
    Route::get('/book/favorite', 'BookController@favorite');
    Route::post('/book/{book}/bookshelf', 'BookController@add');
    Route::resource('/book', 'BookController');
    Route::delete('/bookshelf/{bookshelf}/book/{book}', 'BookShelfController@remove');
    Route::resource('/bookshelf', 'BookShelfController');
    Route::resource('/feed', 'FeedController');
    Route::post('/like/{book}', 'BookController@liked');
    Route::delete('/like/{book}', 'BookController@unlike');
});

Route::get('/home/book', 'HomeController@bookIndex');
Route::resource('/home', 'HomeController');
Route::get('/signup', 'Auth\SignupController@create');
Route::post('/signup', 'Auth\SignupController@store');
Route::get('/login', 'Auth\AuthController@index')->name('login');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('/password/reset', 'Auth\ResetController@create');
Route::post('/password/reset', 'Auth\ResetController@store');
Route::get('/logout', 'Auth\AuthController@logout');



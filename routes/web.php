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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/{any}', 'HomeController@index')->where('any', '.*');

// Route::get('/', 'HomeController@index')->name('home');

Route::resource('artists', 'ArtistController');
Route::resource('genres', 'GenreController');
Route::resource('pochettes', 'PochetteController');
Route::resource('vinyls', 'VinylController');
Route::resource('users', 'UserController');

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
Auth::routes();

Route::get('{driver}/authorise', 'SocialAccountsController@redirectToProvider')->name('login.social');
Route::get('{driver}/login', 'SocialAccountsController@handleProviderCallback')->name('login.social.callback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@landing')->name('default');

Route::middleware(['auth'])->group(function () {
    Route::post('/words/{id?}', 'WordsController@store')->name('words.store');
});

//Route::get('/words', 'WordsController@index')->name('words.index');
Route::get('/words/{id}', 'WordsController@show')->name('words.show');

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::resource('event', 'EventController');
Route::resource('users', 'UsersController');

Route::get('/', 'EventController@index')->name('events');
//Route::get('events', 'EventController@index')->name('events');
Route::get('{event}/update', 'EventController@update')->name('events.update');
Route::get('{event}', 'EventController@show')->name('events.show');
Route::post('events', 'EventController@addEvent')->name('events.add');

Route::get('/home', 'HomeController@index')->name('home');

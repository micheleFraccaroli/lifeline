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

Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');
Route::get('/friends', 'FriendController@index');
Route::get('/friends/{id_utente1}', 'FriendController@showFriend');
Route::get('/conversations','ConversationController@index');
Route::get('/conversations/{id}','ConversationController@get_id');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

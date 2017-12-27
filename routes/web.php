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

//Users
Route::get('/users', 'UserController@index');
Route::post('/users/conversation', 'UserController@test_ajax');
Route::get('/users/update/{id}', 'UserController@edit');
Route::get('/users/{id}', 'UserController@show');
Route::post('/users/{id}', 'UserController@update');
Route::post('/users/pic/{id}', 'UserController@pic');

//Groups
Route::get('/groups/index','GroupController@index');
Route::get('/groups/index/{id}','GroupController@show');
Route::get('/groups/create','GroupController@create');
Route::post('/groups','GroupController@store');
Route::get('/groups/{id}/edit','GroupController@edit');
Route::post('/groups/{id}','GroupController@update');
Route::post('/groups/index','GroupController@test');

//Friends
Route::get('/friends', 'FriendController@index');
Route::get('/friends/{id_utente1}', 'FriendController@showFriend');

//Comments
Route::get('/comments', 'CommentController@index');
Route::get('/comments/{id_post}', 'CommentController@showPost');

//Friends
Route::get('/friends', 'FriendController@index');
Route::get('/friends/{id_utente1}', 'FriendController@showFriend');

//Conversations
Route::get('/conversations','ConversationController@index');
Route::post('/conversations/create','ConversationController@create');
//Route::post('/conversations/{$id}', 'ConversationController@create');

Route::get('/conversations/{id}','ConversationController@get_id');

//Notifies
Route::get('/notifies', 'NotifieController@index');
Route::get('/notifies/{id}', 'NotifieController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
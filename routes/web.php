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

//Users
Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');

//Groups
Route::get('/groups/index','GroupController@index');
Route::get('/groups/index/{id}','GroupController@show');
Route::get('/groups/create','GroupController@create');
Route::post('/groups','GroupController@store');
Route::get('/groups/{id}/edit','GroupController@edit');
Route::post('/groups/{id}','GroupController@update');

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
Route::get('/conversations/{id}','ConversationController@get_id');
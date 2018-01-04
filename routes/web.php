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
Route::get('/contacts', 'UserController@index');
Route::post('/search', 'UserController@search');
Route::post('/users/conversation', 'UserController@test_ajax');
Route::get('/users/update/{id}', 'UserController@edit');
Route::get('/users/{id}', 'UserController@show');
Route::post('/users/{id}', 'UserController@update');
Route::get('/logout', 'LoginController@logout');

//Groups
Route::get('/groups/index','GroupController@index');
Route::get('/groups/index/{id}','GroupController@show');
Route::get('/groups/create','GroupController@create');
Route::post('/groups','GroupController@store');
Route::get('/groups/{id}/edit','GroupController@edit');
Route::post('/groups/{id}','GroupController@update');
Route::get('/posts/{id}','PostController@show_comments');
Route::post('/posts','PostController@store_post_group');

//Friends
Route::get('/friends', 'FriendController@index');
Route::get('/friends/{id_utente1}', 'FriendController@showFriend');
Route::post('/friends/req', 'FriendController@friendshipRequest');
Route::get('/friends/resp', 'FriendController@friendshipRespond');

//Comments
Route::get('/comments', 'CommentController@index');
Route::get('/comments/{id_post}', 'CommentController@showPost');
Route::post('/comments','CommentController@store');

//Conversations
Route::get('/conversations','ConversationController@index');
Route::post('/conversations/create','ConversationController@create');

Route::get('/conversations/{id}','ConversationController@get_id');

//Notifies
Route::get('/notifies', 'NotifieController@index');
Route::get('/notifies/{id}', 'NotifieController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/post','PostController@create');
<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadsController@index')->name('all_threads');
Route::post('/threads', 'ThreadsController@store')->name('store_new_thread');
Route::get('/threads/create', 'ThreadsController@create')->name('create_thread');
Route::get('/threads/{channel}', 'ThreadsController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('show_thread');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('store_reply');


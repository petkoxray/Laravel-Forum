<?php

Auth::routes();
Route::get('/register/confirm', 'Auth\RegisterConfirmationController@index')->name('register_confirm');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'roles:admin'], function () {
    Route::get('/', 'HomeController@index');
    Route::post('/threads/{thread}/lock', 'LockedThreadsController@store')->name('lock_thread');
    Route::delete('/threads/{thread}/lock', 'LockedThreadsController@destroy')->name('unlock_thread');
});

Route::get('/profiles/{user}', 'ProfilesController@show')->name('user_profile');
Route::delete('/profiles/{user}/notifications/{notification}',
    'UserNotificationsController@destroy')->name('remove_notification');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index')->name('user_notifications');

Route::get('api/users', "Api\UsersController@index")->middleware('auth')->name('users');

Route::get('users/{user}/settings/', 'UserSettingsController@index')->middleware('auth')->name('user_settings');
Route::post('users/{user}/avatar', 'UserSettingsController@store_avatar')->middleware('auth')->name('store_avatar');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadsController@index')->name('all_threads');
Route::post('/threads', 'ThreadsController@store')->name('store_new_thread')->middleware('must-be-confirmed');
Route::get('/threads/create', 'ThreadsController@create')->name('create_thread');
Route::get('/threads/{channel}', 'ThreadsController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('show_thread');
Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy')->name('delete_thread');
Route::patch('/threads/{channel}/{thread}', 'ThreadsController@update')->name('update_thread');

Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptions@store')->name('subscribe_to_thread');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptions@destroy')->name('subscribe_to_thread');


Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('store_reply');
Route::patch('/replies/{reply}', 'RepliesController@update')->name('update_reply');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('destroy_reply');

Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('favorite_reply');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('favorite_reply');
Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('store_best_reply');
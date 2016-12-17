<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

Route::get('/center', 'CenterController@index');
Route::get('/center/requests', 'CenterController@requests');
Route::get('/center/schedule', 'CenterController@schedule');

/**
 * Profile view structure
 */
Route::get('/center/profile', 'CenterController@showProfile');
Route::post('/center/profileEdit', 'CenterController@editProfile');
Route::post('/center/profile', 'CenterController@updateProfile');
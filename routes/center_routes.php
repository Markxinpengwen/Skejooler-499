<?php

Route::get('/center', 'CenterController@index');

/**
 * Profile view structure
 */
Route::get('/center/profile', 'CenterController@showProfile');
Route::post('/center/profileEdit', 'CenterController@editProfile');
Route::post('/center/profile', 'CenterController@updateProfile');

/**
 * Schedule / request view structure
 */
Route::get('/center/schedule', 'CenterController@showSchedule');
Route::post('/center/request', 'CenterController@showRequest');
Route::post('/center/requestEdit', 'CenterController@editRequest');
Route::post('/center/schedule', 'CenterController@updateRequest');
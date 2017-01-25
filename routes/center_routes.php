<?php

Route::get('/center', 'CenterController@index');
Route::get('/center/requests', 'CenterController@requests');
Route::get('/center/schedule', 'CenterController@schedule');

/**
 * Profile view structure
 */
Route::get('/center/profile', 'CenterController@showProfile');
Route::post('/center/profileEdit', 'CenterController@editProfile');
Route::post('/center/profile', 'CenterController@updateProfile');

Route::get('/center/schedule', 'CenterController@showSchedule');

//Route::get('/center/request', 'CenterController@showRequest');
//Route::post('/center/requestEdit', 'CenterController@editRequest');
//Route::post('/center/request', 'CenterController@updateRequest');
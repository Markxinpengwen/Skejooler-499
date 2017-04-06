<?php

/**
 * Author: Brett Schaad
 */

// calls index to display default
Route::get('/center', 'CenterController@index');

/**
 * Profile view structure.
 */
// calls showProfile to display profile
Route::get('/center/profile', 'CenterController@showProfile');
// calls editProfile to display profileEdit
Route::post('/center/profileEdit', 'CenterController@editProfile');
// calls update profile to update profile then calls showProfile
Route::post('/center/profile', 'CenterController@updateProfile');

/**
 * Schedule / request view structure.
 */
// calls showSchedule to display schedule
Route::get('/center/schedule', 'CenterController@showSchedule');
// calls showRequest to display request
Route::post('/center/request', 'CenterController@showRequest');
// calls editRequest to display requestEdit
Route::post('/center/requestEdit', 'CenterController@editRequest');
// calls updateRequest to update the request then calls showSchedule
Route::post('/center/schedule', 'CenterController@updateRequest');

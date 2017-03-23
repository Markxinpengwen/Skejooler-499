<?php

Route::get('/student', 'StudentController@index');

/**
 * Profile view structure
 */
Route::get('/student/profile', 'StudentController@showProfile');
Route::post('/student/profileEdit', 'StudentController@editProfile');
Route::post('/student/profile', 'StudentController@updateProfile');

/**
 * Schedule / request view structure
 */
Route::get('/student/schedule', 'StudentController@showSchedule');
Route::post('/student/request', 'StudentController@showRequest');
Route::post('/student/requestEdit', 'StudentController@editRequest');
Route::post('/student/schedule', 'StudentController@updateRequest');

/**
 * Request form view structure
 */
Route::get('/student/examRequestForm', 'StudentController@showSchedule');
Route::post('/student/schedule', 'StudentController@makeRequest');

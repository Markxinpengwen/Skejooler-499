<?php

/**
 * Author: Brett Schaad
 */

// calls index to display default
Route::get('/student', 'StudentController@index');

/**
 * Profile view structure
 */
// calls showProfile to display profile
Route::get('/student/profile', 'StudentController@showProfile');
// calls editProfile to display profileEdit
Route::post('/student/profileEdit', 'StudentController@editProfile');
// calls update profile to update profile then calls showProfile
Route::post('/student/profile', 'StudentController@updateProfile');

/**
 * Schedule / request view structure
 */
// calls showSchedule to display schedule
Route::get('/student/schedule', 'StudentController@showSchedule');
// calls showRequest to display request
Route::post('/student/request', 'StudentController@showRequest');
// calls editRequest to display requestEdit
Route::post('/student/requestEdit', 'StudentController@editRequest');
// calls updateRequest to update the request then calls showSchedule
Route::post('/student/schedule', 'StudentController@updateRequest');

/**
 * Request form view structure.
 */
// calls showExamRequestForm to display examRequestForm
Route::get('/student/examRequestForm', 'StudentController@showExamRequestForm');
// calls createRequest to make a request then calls showExamRequestForm
Route::post('/student/examRequestForm', 'StudentController@createRequest');

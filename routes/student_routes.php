<?php
Route::get('/student', 'StudentController@index');
Route::get('/student/requests', 'StudentController@requests');
Route::get('/student/schedule', 'StudentController@schedule');
/**
 * Profile view structure
 */
Route::get('/student/profile', 'StudentController@showProfile');
Route::post('/student/profileEdit', 'StudentController@editProfile');
Route::post('/student/profile', 'StudentController@updateProfile');
Route::get('/student/schedule', 'StudentController@showSchedule');
//Route::get('/student/request', 'StudentController@showRequest');
//Route::post('/student/requestEdit', 'StudentController@editRequest');
//Route::post('/student/request', 'StudentController@updateRequest');
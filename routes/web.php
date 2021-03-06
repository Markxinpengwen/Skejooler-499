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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', 'NameController@index');
//Route::get('/center', 'UserController@center');
//Route::get('/student', 'UserController@student');
/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';
require __DIR__.'/center_routes.php';
require __DIR__.'/student_routes.php';
<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
    //users
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
    Route::get('updateUser/{id}', 'LA\DashboardController@updateUser');
    Route::get('delUser/{id}', 'LA\DashboardController@delUser');
    Route::get('la/addUser', 'LA\DashboardController@addUser');
    Route::post('addUser', ['as' => 'addUser', 'uses'=>'LA\DashboardController@addU']);
//    Route::post('updateUsers/{id}', ['as' => 'updateUsers', 'uses'=>'LA\DashboardController@do_updateUsers']);

    //students
	Route::get('la/students', 'LA\DashboardController@students');
    Route::get('la/updateStud/{id}', 'LA\DashboardController@updateStud');
    Route::get('la/delStud/{id}', 'LA\DashboardController@delStud');
    Route::get('la/addStud', 'LA\DashboardController@addStud');
    Route::post('la/addStud', ['as' => 'la/addStud', 'uses'=>'LA\DashboardController@addS']);

    //centers
    Route::get('la/centers', 'LA\DashboardController@centers');
    Route::get('la/updateCen/{id}', 'LA\DashboardController@updateCen');
    Route::get('la/delCen/{id}', 'LA\DashboardController@delCen');
    Route::get('la/addCen', 'LA\DashboardController@addCen');
    Route::post('la/addCen', ['as' => 'la/addCen', 'uses'=>'LA\DashboardController@addC']);

    //requests
    Route::get('la/requests', 'LA\DashboardController@requests');
    Route::get('la/updateReq/{id}', 'LA\DashboardController@updateReq');
    Route::get('la/delReq/{id}', 'LA\DashboardController@delReq');

	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	

});

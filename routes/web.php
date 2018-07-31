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

//LOGIN ROUTE
Route::get('/', 'Auth\LoginController@login');

Route::get('login', 'Auth\LoginController@login');
Route::post('user/login', 'Auth\LoginController@doLogin');
Route::get('logout', 'Auth\LoginController@logout');

// ADMINISTRATOR  ROUTES
$router->group(['middleware' => 'auth'], function($router)
{
	$router->get('home','Administration\DashboardController@homeAction');
	$router->resource('administration/dashboard', 'Administration\DashboardController');
	$router->resource('administration/user', 'Administration\UserController');
	$router->resource('administration/group-management', 'Administration\GroupManagementController');
	$router->resource('administration/assign-task', 'Administration\TaskManagementController');
	$router->resource('administration/task-management', 'Administration\TaskManagementController');
	$router->resource('administration/master-group', 'Administration\MasterGroupController');
	$router->resource('administration/master-tasks', 'Administration\MasterTasksController');
	// SEARCH APIS
	$router->get('search-users', 'Administration\UserController@searchUserAction');
	$router->get('search-tasks', 'Administration\GroupManagementController@searchTasksAction');
	// GET ALL MEMBERS WRT GROUPS
	$router->get('get/group-members', 'Administration\GroupManagementController@getGroupMembersAction');
	// ASSIGN TAKS TO GROUP
	$router->get('administration/group-management/assign-tasks/{id}', 'Administration\GroupManagementController@assignTasksAction');
	// STORE GROUP AND TASKS
	$router->post('administration/manage-tasks-group', 'Administration\GroupManagementController@manageTaskGroupActions');
});

// USER  ROUTES
$router->group(['middleware' => 'auth-user'], function($router)
{
	$router->resource('dashboard','Userprofile\DashboardController');
	$router->get('manage-tasks-status/{group}', 'Userprofile\DashboardController@manageTaskStatusAction');
	$router->post('update-task-status', 'Userprofile\DashboardController@updateTaskStatusAction');
	$router->post('change-user-password', 'Userprofile\DashboardController@changePasswordAction');
});


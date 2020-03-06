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


Auth::routes(['verify' => true]);
// Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');


    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    Route::resource('clients', 'ClientController');
    Route::resource('jobs', 'JobController');
    Route::resource('jobtypes', 'JobtypeController');
    Route::resource('staff', 'StaffController');


    Route::get('deletedUsers', 'UserController@deletedUsers')->name('deletedUsers');
    Route::get('search_users/{search}', 'UserController@search_users')->name('search_users');

    Route::get('search_client/{search}', 'ClientController@search_client')->name('search_client');
    Route::get('search_staff/{search}', 'StaffController@search_staff')->name('search_staff');

    Route::get('user_count', 'DashboardController@user_count')->name('user_count');
    Route::get('client_count', 'DashboardController@client_count')->name('client_count');
    Route::get('jobs_count', 'DashboardController@jobs_count')->name('jobs_count');
    Route::get('complete_jobs_count', 'DashboardController@complete_jobs_count')->name('complete_jobs_count');
    Route::get('pedding_jobs_count', 'DashboardController@pedding_jobs_count')->name('pedding_jobs_count');
    Route::get('open_leads_count', 'DashboardController@open_leads_count')->name('open_leads_count');
    Route::get('closed_leads_count', 'DashboardController@closed_leads_count')->name('closed_leads_count');
    Route::get('cancelled_leads_count', 'DashboardController@cancelled_leads_count')->name('cancelled_leads_count');
    Route::get('today_jobs_count', 'DashboardController@today_jobs_count')->name('today_jobs_count');
    Route::get('avarage_revenue', 'DashboardController@avarage_revenue')->name('avarage_revenue');

    Route::post('jobs_report', 'ReportController@jobs_report')->name('jobs_report');

    Route::get('getPermissions', 'RoleController@getPermissions')->name('getPermissions');
    Route::get('getUsersRole', 'RoleController@getUsersRole')->name('getUsersRole');
    Route::get('getRoles', 'RoleController@getRoles')->name('getRoles');
    Route::post('getRolesPerm/{id}', 'RoleController@getRolesPerm')->name('getRolesPerm');
    Route::get('getRoles', 'RoleController@getRoles')->name('getRoles');
    Route::post('getUserPerm/{id}', 'UserController@getUserPerm')->name('getUserPerm');

    Route::patch('status/{id}', 'JobController@status')->name('status');


});

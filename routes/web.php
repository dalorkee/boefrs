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

Auth::routes();
Route::get('/', 'DashboardController@index');
Route::get('/home', 'DashboardController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
	Route::resource('roles','RoleController');
	Route::resource('users','UserController');
	Route::resource('products','ProductController');
	Route::resource('dashboard', 'DashboardController');
	Route::resource('code', 'CodeController');
	Route::resource('list-data', 'ListDataController');
});

/* Hospital Lab */
//Route::get('/home1', 'HospitalController@hospitalHome')->name('home1');

/* Ajax request for generate lab code */
Route::post('ajaxRequest', 'CodeController@ajaxRequestPost')->name('ajaxRequest');

/* Ajax request for update patient table */
Route::get('/ajaxRequestTable', 'CodeController@ajaxRequestTable')->name('ajaxRequestTable');

/* Hospital print data form */
//Route::get('/hospital', 'HospitalController@hospitalLab')->name('hospital');

/* Sample Submission Form */
Route::get('/sample-submissions-form', array(
			'as'   => 'sample-submission.form',
			'uses' => 'SampleSubmissionsController@Form_Sample_Submissions'
));

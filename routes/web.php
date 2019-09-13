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

/* Dashboard */
Route::get('/', function () {
	return view('admin.dashboard.index');
});
Route::get('/dashboard', 'HospitalController@index')->name('dashboard');

/* Hospital Lab */
Route::get('/home', 'HospitalController@hospitalHome')->name('home');

/* Generate code form */
Route::get('/code', 'CodeGenController@index')->name('code');

/* List the lab data */
Route::get('/list', 'ListDataController@index')->name('list');

/* Generate code method */
/* Route::resource('/gen', 'CodeGenController'); */

/* Ajax request for update patient table */
Route::get('/ajaxRequestTable', 'CodeGenController@ajaxRequestTable')->name('ajaxRequestTable');

/* Ajax request for generate lab code */
/* Route::get('ajaxRequest', 'CodeGenController@ajaxRequest')->name('ajaxRequest'); */
Route::post('ajaxRequest', 'CodeGenController@ajaxRequestPost')->name('ajaxRequest');

/* Hospital print data form */
Route::get('/hospital', 'HospitalController@hospitalLab')->name('hospital');

/* Sample Submission Form */
Route::get('/sample-submissions-form', array(
			'as'   => 'sample-submission.form',
			'uses' => 'SampleSubmissionsController@Form_Sample_Submissions'
));

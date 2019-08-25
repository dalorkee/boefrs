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
Route::get('/print', 'HospitalController@print')->name('print');

/* Hospital print data form */
Route::get('/hospital', 'HospitalController@hospitalLab')->name('hospital');

/* Sample Submission Form */
Route::get('/sample-submissions-form', array(
			'as'   => 'sample-submission.form',
			'uses' => 'SampleSubmissionsController@Form_Sample_Submissions'
));

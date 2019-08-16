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
	return view('index');
});

/* Lab */
Route::get('/lab', 'LabController@index')->name('lab');

/* Sample Submission Form */
Route::get('/sample-submissions-form', array(
			'as'   => 'sample-submission.form',
			'uses' => 'SampleSubmissionsController@Form_Sample_Submissions'
));

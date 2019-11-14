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

/* Home */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

/* Auth */
Route::group(['middleware' => ['auth']], function() {
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('dashboard', 'DashboardController');
	Route::resource('code', 'CodeController');
	Route::resource('list-data', 'ListDataController');
});

/* Register */
Route::get('/register', '\App\Http\Controllers\Auth\RegisterController@index')->name('register');
Route::post('register', '\App\Http\Controllers\Auth\RegisterController@register')->name('register');
Route::get('/getHospByProv', '\App\Http\Controllers\Auth\RegisterController@getHospByProv')->name('getHospByProv');

/* Logout */
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

/* Ajax request for generate lab code */
Route::post('ajaxRequest', 'CodeController@ajaxRequestPost')->name('ajaxRequest');

/* Ajax request for update patient table */
Route::get('/ajaxRequestTable', 'CodeController@ajaxRequestTable')->name('ajaxRequestTable');

/* Ajax select */
Route::post('ajaxSelect', 'CodeController@ajaxRequestSelect')->name('ajaxSelect');

/* Ajax request hosp */
Route::get('/ajaxGetHospByProv', 'UserController@ajaxGetHospByProv')->name('ajaxGetHospByProv');

/* Captcha */
Route::get('/refreshcaptcha', 'CaptchaController@refreshCaptcha');

/* Sample Submission Form */
Route::get('/sample-submissions-form', array(
			'as'   => 'sample-submission.form',
			'uses' => 'SampleSubmissionsController@Form_Sample_Submissions'
));

/* delete */
Route::get('/confirmDelete/{id}', 'CodeController@confirmDelete')->name('confirmDelete');
Route::get('/codeSoftDelete/{id}','CodeController@softDelete')->name('codeSoftDelete');

/* fetch district, fetch sub-district */
Route::post('province/district', 'PatientsController@districtFetch')->name('districtFetch');
Route::post('province/district/sub-district', 'PatientsController@subDistrictFetch')->name('subDistrictFetch');

/* patient */
Route::get('/patient/create/{id}', 'PatientsController@create')->name('createPatient');
Route::post('patient/add', 'PatientsController@addPatient')->name('addPatient');
Route::post('patient/edit', 'PatientsController@editPatient')->name('editPatient');

/* list data */
Route::post('data/ajax-list', 'ListDataController@ajaxListData')->name('ajax-list-data');
Route::post('data/list', 'ListDataController@listData')->name('list-data');

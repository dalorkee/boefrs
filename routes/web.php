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
Route::get('refreshcaptcha', 'CaptchaController@refreshCaptcha');

/* Sample Submission Form */
Route::get('/sample-submissions-form', array(
			'as'   => 'sample-submission.form',
			'uses' => 'SampleSubmissionsController@Form_Sample_Submissions'
));

/* code soft deleted */
Route::get('/codeSoftDelete/{id}','CodeController@softDelete')->name('codeSoftDelete');

/* patient */
Route::get('/patient/{id}', 'PatientsController@index')->name('patient');

/* fetch district */
Route::post('/province/district', 'PatientsController@districtFetch')->name('districtFetch');

/* fetch sub-district */
Route::post('/province/district/sub-district', 'PatientsController@subDistrictFetch')->name('subDistrictFetch');

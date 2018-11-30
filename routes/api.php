<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');
Route::get('faq/user', 'PassportController@showFAQUser');

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('profile', 'PassportController@showProfile');
	Route::post('save/fcm/{id}', 'PassportController@saveFCMToken');

	Route::get('booking/show', 'BookingTicketController@index');
	Route::post('booking', 'TicketBookingDetailController@store');
	Route::post('booking/{id}', 'TicketBookingDetailController@tes');
	Route::post('update/booking/{id}', 'TicketBookingDetailController@update');
	Route::delete('delete/booking/{id}', 'TicketBookingDetailController@destroy');
	Route::put('delete/master/{id}', 'TicketBookingDetailController@destroyMaster');
	Route::get('booking/payment', 'BookingTicketController@payment');
	Route::post('edit/profile', 'PassportController@editProfile');

	/*=========================================================================
								ADMIN API ROUTE
	=========================================================================*/
	Route::get('admin/booking/payment', 'AdminController@index');
	Route::get('admin/booking/verifikasi/{id}', 'AdminController@verifikasi');
	Route::post('admin/add/admin', 'AdminController@addAdmin');
	Route::post('admin/add/seminar', 'AdminController@addSeminarInfo');
	Route::get('admin/show/seminar', 'AdminController@showSeminar');
	Route::get('admin/show/admin', 'AdminController@dataAdmin');
	Route::post('admin/update/seminar/{id}', 'AdminController@editSeminarInfo');
	Route::get('show/faq', 'AdminController@showFAQ');
	Route::post('admin/add/faq', 'AdminController@addFAQ');
	Route::post('admin/update/faq/{id}', 'AdminController@updateFAQ');
	Route::delete('admin/delete/faq/{id}', 'AdminController@deleteFAQ');
	Route::get('admin/scan/tiket/{token}', 'AdminController@scanTiket');

	Route::get('admin/send/notif/{id}', 'AdminController@sendNotif');
	Route::get('admin/send/cancel/notif/{id}', 'AdminController@sendCancelNotif');
	Route::get('admin/show/peserta', 'AdminController@showPeserta');
});
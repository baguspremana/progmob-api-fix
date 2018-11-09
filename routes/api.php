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

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('booking/show', 'BookingTicketController@index');
	Route::post('booking', 'TicketBookingDetailController@store');
	Route::put('booking/{booking}', 'TicketBookingDetailController@updateVerification');
});
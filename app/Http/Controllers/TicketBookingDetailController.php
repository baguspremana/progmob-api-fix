<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketBooking;
use App\TicketBookingDetail;
use Validator;

class TicketBookingDetailController extends Controller
{
	
	public public function showStore()
	{
		// $user = request()->user();

		// return $user;
		return 'a';
	}

    public function store(Request $request)
    {

    	$user = request()->user();

    	$user_id = TicketBooking::where('user_id', $user['id'])
    		->max('user_id');

    	$currentDateTime = date('Y-m-d');

    	$created_at = date('Y-m-d', 
    				strtotime(TicketBooking::where('user_id', $user['id'])
    				->max('created_at')));

    	$booking_id = TicketBooking::where('user_id', $user['id'])
    		->max('id');

    	if ($created_at==null and $user_id==null) {

    		$validator = Validator::make($request->all(), [
	            'booking_name' => 'required|unique:ticket_booking_details',
	            'booking_email' => 'required|email|unique:ticket_booking_details',
	            'booking_contact' => 'required|numeric|unique:ticket_booking_details',
	            'booking_veget' => 'required',
	            'booking_institution' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return response()->json([
	            	'success' => false,
	            	'error'=>$validator->errors()
	            ], 401);            
	        }

    		$ticket = new TicketBooking;
    		$ticket->user_id = $user['id'];
    		$ticket->status = 1;
    		$ticket->save();

    		TicketBookingDetail::create([
	    		'booking_id' => $ticket->id,
	    		'booking_name' => $request->booking_name,
	    		'booking_email' => $request->booking_email,
	    		'booking_contact' => $request->booking_contact,
	    		'booking_veget' => $request->booking_veget,
	    		'booking_institution' => $request->booking_institution,
	    		'booking_price' => 75000,
	    		'status' => 1
	    	]);

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'berhasil'
	    	]);

    	}elseif ($currentDateTime > $created_at) {

    		$validator = Validator::make($request->all(), [
	            'booking_name' => 'required|unique:ticket_booking_details',
	            'booking_email' => 'required|email|unique:ticket_booking_details',
	            'booking_contact' => 'required|numeric|unique:ticket_booking_details',
	            'booking_veget' => 'required',
	            'booking_institution' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return response()->json([
	            	'success' => false,
	            	'error'=>$validator->errors()
	            ], 401);            
	        }

    		$ticket = new TicketBooking;
    		$ticket->user_id = $user['id'];
    		$ticket->status = 1;
    		$ticket->save();

    		TicketBookingDetail::create([
	    		'booking_id' => $ticket->id,
	    		'booking_name' => $request->booking_name,
	    		'booking_email' => $request->booking_email,
	    		'booking_contact' => $request->booking_contact,
	    		'booking_veget' => $request->booking_veget,
	    		'booking_institution' => $request->booking_institution,
	    		'booking_price' => 75000,
	    		'status' => 1
	    	]);

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'berhasil'
	    	]);
    		
    	}else{

    		$validator = Validator::make($request->all(), [
	            'booking_name' => 'required|unique:ticket_booking_details',
	            'booking_email' => 'required|email|unique:ticket_booking_details',
	            'booking_contact' => 'required|numeric|unique:ticket_booking_details',
	            'booking_veget' => 'required',
	            'booking_institution' => 'required',
	        ]);

	        if ($validator->fails()) {
	            return response()->json([
	            	'success' => false,
	            	'error'=>$validator->errors()
	            ], 401);            
	        }

	        TicketBookingDetail::create([
	    		'booking_id' => $booking_id,
	    		'booking_name' => $request->booking_name,
	    		'booking_email' => $request->booking_email,
	    		'booking_contact' => $request->booking_contact,
	    		'booking_veget' => $request->booking_veget,
	    		'booking_institution' => $request->booking_institution,
	    		'booking_price' => 75000,
	    		'status' => 1
	    	]);

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'berhasil'
	    	]);

    	}
    }

    public function updateVerification(Request $request, $id)
    {
    	$ticket = TicketBooking::find($id);

    	return $ticket;
    }
}

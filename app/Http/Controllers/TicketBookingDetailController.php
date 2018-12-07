<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketBooking;
use App\TicketBookingDetail;
use Validator;
use App\Seminar;

class TicketBookingDetailController extends Controller
{

    public function store(Request $request)
    {
    	$seminar = Seminar::first();

    	$user = request()->user();

        // return $user;

    	$user_id = TicketBooking::where('user_id', $user['id'])
    		->max('user_id');

        // return $user_id;

    	$currentDateTime = date('Y-m-d');

    	$created_at = date('Y-m-d', 
    				strtotime(TicketBooking::where('user_id', $user['id'])
    				->max('created_at')));

        // return $created_at;

        $booking_id = TicketBooking::where('user_id', $user['id'])
            ->max('id');

        // return $booking_id;

        if ($booking_id != null) {

            $status_max = TicketBooking::where('user_id', $user['id'])
            ->select('status')
            ->orderBy('status', 'desc')
            ->first()
            ->status;
            
        }else{

            $status_max = 1;
        }

        // return $status_max;
        // $status_int = (int)$status_max;

    	// return $status_int;

    	if ($user_id==null) {
            // return 'a';

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

	    	$seminar->ticket_available = $seminar->ticket_available-1;
	    	$seminar->save();

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'berhasil'
	    	]);

    	}elseif ($status_max==2) {
    		// return 'b';

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

	    	$seminar->ticket_available = $seminar->ticket_available-1;
	    	$seminar->save();

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'berhasil'
	    	]);

    	}else{
            // return 'c';

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

	    	$seminar->ticket_available = $seminar->ticket_available-1;
	    	$seminar->save();

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'berhasil'
	    	]);

    	}
    }

    public function tes(Request $request, $id)
    {
    	// return $request;
    	$ticket = TicketBooking::find($id);

    	if($request->file('photo') != null){
    		// return "ada foto";
            $photo = $ticket->id.".".$request->file('photo')->getClientOriginalExtension();
            try{
                TicketBooking::uploadPhoto($request->file('photo'), $photo);
                $ticket->photo = $photo;
        		$message['success'] = 'Berhasil mengubah data anggota';

            } catch(Exception $e) {
                $message['error'] = "Gagal upload gambar!";
            }
        }else{
        	return response()->json([
        		'success' => false,
        		'message' => 'error'
        	], 401);
        }
        $ticket->etc = $request->etc;
        $ticket->save();
    	return response()->json([
	    	'status' => 200,
	    	'message' => 'berhasil'
	    ]);
    }

    public function update(Request $request, $id)
    {
    	$ticket = TicketBookingDetail::find($id);

    	if ($ticket->status==2) {

    		return response()->json([
	            'success' => false,
	            'error'=> 'update tidak dijinkan'
	        ], 401);

    	}else{

	        $ticket->booking_name = $request->booking_name;
	        $ticket->booking_email = $request->booking_email;
	        $ticket->booking_contact = $request->booking_contact;
	        $ticket->booking_veget = $request->booking_veget;
	        $ticket->booking_institution = $request->booking_institution;
	        $ticket->save();

    		return response()->json([
    			'status' => 200,
    			'message' => 'update data berhasil'
    		]);
    	}

    }

    public function destroy($id)
    {
    	$ticket = TicketBookingDetail::find($id);
    	$seminar = Seminar::first();

    	// return $seminar;

    	if ($ticket->status == 2) {

    		return response()->json([
	            'success' => false,
	            'error'=> 'update tidak dijinkan'
	        ], 401);

    	}else{
    		$ticket->delete();

    		$seminar->ticket_available = $seminar->ticket_available+1;
	    	$seminar->save();

    		return response()->json([
	    		'status' => 200,
	    		'message' => 'update data berhasil'
	    	]);
    	}
    	
    }

    public function destroyMaster($id)
    {
    	$details = TicketBookingDetail::where('booking_id', $id)
    		->get();

    	$seminar = Seminar::first();

    	// return $seminar;

    	$ticket = TicketBooking::find($id);
    	$ticket->status = 0;
    	$ticket->save();

    	foreach ($details as $key => $detail) {
    		$detail_ticket = TicketBookingDetail::find($detail->id);
    		$detail_ticket->status = 0;
    		$detail_ticket->save();

    		$seminar->ticket_available = $seminar->ticket_available+1;
	    	$seminar->save();
    	}

    	return response()->json([
    		'status' => 200,
    		'message' => 'berhasil menghapus data'
    	]);
    }
}

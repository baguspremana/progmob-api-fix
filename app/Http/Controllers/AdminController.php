<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\TicketBooking;
use App\TicketBookingDetail;
use DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function index()
    {
    	$user = request()->user();

    	// return $user;
    	if ($user['role'] == 2) {
    		$ticket = DB::table('ticket_bookings')
            ->join('ticket_booking_details','ticket_bookings.id','=','ticket_booking_details.booking_id')
            ->join('users', 'users.id','=','ticket_bookings.user_id')
            ->select('ticket_bookings.id', 'users.id as user_id', 'users.name',
            	'ticket_bookings.photo',
                DB::raw('count(ticket_booking_details.id) as jumlah_ticket'),
                DB::raw('sum(ticket_booking_details.booking_price) as total_harga'), 'ticket_bookings.created_at', 'ticket_bookings.updated_at')
            ->where('ticket_bookings.status', '!=', 0)
            ->where('ticket_booking_details.status', '!=', 0)
            ->groupBy('ticket_bookings.id', 'users.id',
            		'users.name', 'ticket_bookings.photo', 'ticket_bookings.created_at','ticket_bookings.updated_at')
            ->get();
            return $ticket;

    	}else{
    		return response()->json([
    			'success' => false,
    			'message' => 'Anda tidak bisa melihat data ini'
    		]);
    	}

    }

    public function verifikasi($id)
    {
    	$user = request()->user();

    	if ($user['role'] == 2) {

    		$details = TicketBookingDetail::where('booking_id', $id)
    					->get();

    		$ticket = TicketBooking::find($id);
    		$ticket->status = 2;
    		$ticket->save();

    		foreach ($details as $key => $detail) {
    			$detail_ticket = TicketBookingDetail::find($detail->id);
    			$detail_ticket->status = 2;
    			$detail_ticket->booking_code = bin2hex(openssl_random_pseudo_bytes(10));
    			$detail_ticket->save();

    			$qr_code = $detail_ticket->booking_code;

    			$detail_ticket->qrcode_photo = $qr_code.'.png';
    			$detail_ticket->save();
    			QRCode::format('png')->size(600)->generate($qr_code,'../public/uploads/qrcode/'.$qr_code.'.png');
    		}

    		return response()->json([
    			'status' => 200,
    			'message' => 'berhasil verifikasi pemesanan tiket'
    		]);

    	}else{
    		return response()->json([
    			'success' => false,
    			'message' => 'Anda tidak bisa melihat data ini'
    		]);
    	}
    	
    }

    public function addAdmin(Request $request)
    {
    	$user = request()->user();

    	if ($user['role'] == 2) {
    		// return $request;
    		$validator = Validator::make($request->all(), [
    			'name' => 'required',
    			'email' => 'required|email|unique:users',
    			'contact' => 'required|unique:users',
            	'password' => 'required|min:6',
    		]);

    		if ($validator->fails()) {
	            return response()->json([
	            	'success' => false,
	            	'error'=>$validator->errors()
	            ], 401);            
	        }

	        $admin = new User();
	        $admin->name = $request->name;
	        $admin->email = $request->email;
	        $admin->contact = $request->contact;
	        $admin->role = 2;
	        $admin->password = bcrypt($request->password);
	        $admin->save();

	        return response()->json([
    			'status' => 200,
    			'message' => 'berhasil menambah admin'
    		]);

    	}else{
    		return response()->json([
    			'success' => false,
    			'message' => 'Anda tidak mengakses menu ini'
    		]);
    	}
    }
}

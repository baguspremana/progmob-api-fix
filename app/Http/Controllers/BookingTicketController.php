<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketBooking;
use App\TicketBookingDetail;
use DB;

class BookingTicketController extends Controller
{
    public function index()
    {
        $user = request()->user();

        $ticket = TicketBooking::where('user_id', $user['id'])
            ->where('ticket_booking_details.status', '!=', 0)
            ->select('ticket_bookings.*', 'ticket_booking_details.*')
            ->join('ticket_booking_details', 'ticket_bookings.id', '=', 'ticket_booking_details.booking_id')
            ->get();

        return $ticket;
    }

    public function payment()
    {
        $user = request()->user();

        $ticket = DB::table('ticket_bookings')
            ->join('ticket_booking_details','ticket_bookings.id','=','ticket_booking_details.booking_id')
            ->select('ticket_bookings.id',
                DB::raw('count(ticket_booking_details.id) as jumlah_ticket'),
                DB::raw('sum(ticket_booking_details.booking_price) as total_harga'))
            ->where('ticket_bookings.user_id', $user['id'])
            ->where('ticket_bookings.status', '!=', 0)
            ->where('ticket_booking_details.status', '!=', 0)
            ->groupBy('ticket_bookings.id')
            ->get();

        return response()->json($ticket);
    }
}

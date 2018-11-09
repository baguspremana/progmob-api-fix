<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketBooking;
use App\TicketBookingDetail;

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
}

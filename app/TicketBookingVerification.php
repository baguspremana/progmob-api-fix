<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketBookingVerification extends Model
{
    protected $fillable = [
        'booking_id', 'verification', 'etc',
    ];

    public function ticketBooking()
    {
    	return $this->belongsTo('App\TicketBooking', 'booking_id');
    }
}

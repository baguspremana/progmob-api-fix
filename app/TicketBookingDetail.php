<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketBookingDetail extends Model
{
    public static $dir_qrcode = "uploads/qrcode";
    
    protected $fillable = [
        'booking_id', 'booking_code', 'booking_name', 
        'booking_email', 'booking_contact', 'booking_veget',
        'booking_institution', 'booking_price', 'status',
        'qrcode_photo',
    ];

    public function ticketBooking()
    {
    	return $this->belongsTo('App\TicketBooking', 'booking_id');
    }
}

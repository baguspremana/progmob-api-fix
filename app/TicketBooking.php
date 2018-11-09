<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketBooking extends Model
{
    public static $dir_photo = "/uploads/verification/";

    protected $fillable = [
        'user_id', 'status', 'verfication', 'etc',
    ];

    public function ticketBookingDetail()
    {
    	return $this->hasMany('App\TicketBookingDetail');
    }

    public function ticketBookingVerification()
    {
    	return $this->hasMany('App\TicketBookingVerification');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public static function uploadPhoto($file, $file_name){
        $destinationPath = public_path(TicketBooking::$dir_photo);
        return $file->move($destinationPath, $file_name);
    }
}

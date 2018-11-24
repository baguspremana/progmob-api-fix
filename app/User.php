<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public static $dir_photo = "/uploads/profile/";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'photo_profile', 'gender', 
        'contact', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ticketBooking()
    {
        return $this->hasMany('App\TicketBooking');
    }

    public function seminar()
    {
        return $this->hasMany('App\Seminar');
    }

    public static function uploadPhoto($file, $file_name){
        $destinationPath = public_path(User::$dir_photo);
        return $file->move($destinationPath, $file_name);
    }
}

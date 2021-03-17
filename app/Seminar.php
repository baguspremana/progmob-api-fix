<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $fillable = [
        'seminar_name', 'seminar_theme', 'seminar_description',
        'seminar_schedule', 'seminar_location', 'ticket_available'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}

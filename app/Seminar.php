<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $fillable = [
        'seminar_name', 'seminar_theme',
        'seminar_schedule', 'seminar_location',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}

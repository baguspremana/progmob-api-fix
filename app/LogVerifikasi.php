<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogVerifikasi extends Model
{
    protected $fillable = [
        'booking_detail_id', 'status',
    ];
}

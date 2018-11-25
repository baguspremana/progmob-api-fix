<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
	public $table = "f_a_qs";

    protected $fillable = [
        'user_id', 'question', 'answer',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}

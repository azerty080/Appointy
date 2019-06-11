<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $table = 'appointments';

    protected $fillable = [
        'date', 'time', 'time_in_min', 'details', 'sendreminder'
    ];


    public function business() {
      	return $this->belongsTo('App\Business');
    }

    public function client() {
		return $this->belongsTo('App\Client');
    }
}

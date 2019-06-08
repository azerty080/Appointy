<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningHour extends Model
{
    // use SoftDeletes;

    protected $table = 'openinghours';

    protected $fillable = [
        'dayofweek', 'opentime', 'closetime', 'closed', 'opentime_in_min', 'closetime_in_min'
    ];

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}

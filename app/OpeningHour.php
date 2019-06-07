<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningHour extends Model
{
    // use SoftDeletes;

    protected $table = 'openinghours';

    protected $fillable = [
        'dayofweek', 'openingtime', 'closetime', 'closed'
    ];

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}

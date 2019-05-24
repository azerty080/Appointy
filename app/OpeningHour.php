<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningHour extends Model
{
    // use SoftDeletes;

    protected $table = 'openinghours';

    protected $fillable = [
        'day', 'openingtime', 'closetime'
    ];

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}

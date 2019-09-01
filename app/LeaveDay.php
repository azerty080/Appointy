<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveDay extends Model
{
    // use SoftDeletes;
    
    protected $table = 'leavedays';

    protected $fillable = [
        'date', 'repeat'
    ];

    public function business()
    {
        return $this->belongsTo('App\Business');
    }
}

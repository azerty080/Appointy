<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    // use SoftDeletes;

    protected $table = 'businesses';

    protected $fillable = [
        'name', 'profession', 'description', 'appointmentduration'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    

    public function bookmark()
    {
        return $this->hasMany('App\Bookmark');
    }

    public function openinghour()
    {
        return $this->hasMany('App\OpeningHour');
    }

    public function leaveday()
    {
        return $this->hasMany('App\LeaveDay');
    }
}

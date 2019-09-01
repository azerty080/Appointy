<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    // use SoftDeletes;
    
    protected $table = 'clients';

    protected $fillable = [
        'firstname', 'lastname', 'birthdate'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }



    public function bookmark()
    {
        return $this->hasMany('App\Bookmark');
    }

    public function appointment()
    {
        return $this->hasMany('App\Appointment');
    }
}

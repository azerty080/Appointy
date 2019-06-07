<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'email', 'password', 'township', 'address', 'phonenumber'
    ];


    public function client() {
        return $this->hasMany('App\Client');
    }

    public function business() {
        return $this->hasOne('App\Business');
    }
}

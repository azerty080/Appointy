<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmark extends Model
{
    use SoftDeletes;
  
    protected $table = 'bookmarks';

    public function business() {
		return $this->belongsTo('App\Business');
	}

    public function client() {
		return $this->belongsTo('App\Client');
    }
}

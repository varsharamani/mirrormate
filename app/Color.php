<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
	protected $table = "colors";
	public $primarykey = "id";
	public $timestamps = true;
	
    public function mirrormate(){
    	return $this->belongsTo('App\Mirrormate');
    }
}

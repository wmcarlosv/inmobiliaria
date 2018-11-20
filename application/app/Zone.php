<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = 'zones';
    protected $fillable = ['city_id','name'];

    public function city(){
    	return $this->belongsTo('App\City');
    }
}

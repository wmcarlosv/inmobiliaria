<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name','departament_id'];


    public function departament(){
    	return $this->belongsTo('App\Departament');
    }
}

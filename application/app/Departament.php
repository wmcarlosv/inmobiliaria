<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departaments';
    protected $fillable = ['name'];

    public function cities(){
    	return $this->belognsToMany('App\City');
    }
}

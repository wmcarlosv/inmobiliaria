<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    protected $table = 'property_photos';
    protected $fillable = ['property_id','name','url'];
}

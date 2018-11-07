<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";
    protected $fillable = ["direction_id","property_type_id","management_id","description","price","stratum","square_meter","consultant_id"];

    public function amenities(){
    	return $this->belongsToMany('App\Amenity','property_amenities','property_id','amenity_id');
    }

    public function features(){
    	return $this->belongsToMay('App\Feature','property_features','property_id','feature_id');
    }

    public function property_type(){
    	return $this->belongsTo('App\PropertyType');
    }

    public function management(){
    	return $this->belongsTo('App\Management');
    }
}

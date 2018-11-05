<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";
    protected $fillable = ["direction_id","property_type_id","management_id","description","price","stratum","square_meter","consultant_id"];
}

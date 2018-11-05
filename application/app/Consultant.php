<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    protected $table = "consultants";
    protected $fillable = ["name","phone","email","direction","avatar"];
}

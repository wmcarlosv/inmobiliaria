<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = "directions";
    protected $fillable = ['departament','zone','ubication'];
}

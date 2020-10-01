<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'lastname',	
        'date_of_birth',	
        'location_id'
    ];
}

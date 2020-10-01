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

    public function location(){
        return $this -> belongsTo(Location::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}

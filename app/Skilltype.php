<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skilltype extends Model
{
    function skills(){
        $this->hasMany('App\Skill');
    }
    
    function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    
    function getNameAttribute($value)
    {
        return ucwords($value);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    function requirement()
    {
        return $this->hasMany('App\Requirement');
    }
    
    function skilltype()
    {
        return $this->belongsTo('App\Skilltype');
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


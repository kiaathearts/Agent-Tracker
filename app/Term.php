<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    function solicitation()
    {
        return $this->hasMany('App\Solicitation');
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

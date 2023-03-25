<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenttype extends Model
{
    /**
     * Define the one to many agent type relationship with agent.
     **/
    function agent(){
        $this->hasMany('App\Agent');
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

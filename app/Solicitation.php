<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitation extends Model
{
    
    function agent()
    {
        return $this->belongsTo('App\Agent');
    }
    
    function requirements()
    {
        return $this->hasMany('App\Requirement');
    }
    
    function term()
    {
        return $this->belongsTo('App\Term');
    }
    
    function setDateOfAttribute($value)
    {
        $this->attributes['date_of'] = strtotime($value);
    }
    
    function getDateOfAttribute($value)
    {
        return date('m/d/Y', $value);
    }
    
    /**
     * Return parent in relation to table with user_id field.
     * 
     * This function is for use with AuthItem's isAuthorized method for recursive user_id
     * search to check view permissions.
     * 
     * @return string|bool Parent table name.
     */
    public function relationToUser()
    {
        return 'agent';
    }
}

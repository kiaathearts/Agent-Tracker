<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * Tie to agent as the parent in the relationship.
     **/
    function agent(){
        return $this->belongsTo('App\Agent');
    }
    
    function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    
    function getNameAttribute($value)
    {
        return ucwords($value);
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

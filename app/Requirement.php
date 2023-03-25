<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    function solicitation()
    {
        return $this->belongsTo('App\Solicitation');
    }
    
    function skill()
    {
        return $this->belongsTo('App\Skill');
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
        return 'solicitation';
    }

}

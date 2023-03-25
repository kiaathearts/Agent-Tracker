<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /**
     * Define the one to many relationship agent has with note.
     **/
    function notes(){
        return $this->hasMany('App\Note');
    }
    
    function agenttype(){
        return $this->belongsTo('App\Agenttype');
    }
    
    function solicitations(){
        return $this->hasMany('App\Solicitation');
    }
    
    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstName'] = strtolower($value);
    }
    
    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }
    
    public function setLastNameAttribute($value)
    {
        $this->attributes['lastName'] = strtolower($value);
    }
    
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function setAgencyAttribute($value)
    {
        $this->attributes['agency'] = strtolower($value);
    }
    
    public function getAgencyAttribute($value)
    {
        return ucwords($value);
    }
    
    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = strtolower($value);
    }
    
    public function getLocationAttribute($value)
    {
        return ucwords($value);
    }
    
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/\D/', '', $value);
    }
    
    public function getPhoneAttribute($value)
    {
       if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $value,  $matches ) )
            {
                $result = '(' . $matches[1] . ') ' .$matches[2] . '-' . $matches[3];
                return $result;
            }
    }
    
    public function scopeWhereOrWithout($query, $field, $condition, $value)
    {
        if($value == "%%"){
            return $query;
        } else {
            return $query->where($field, $condition, $value);
        }
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
        return true;
    }
}

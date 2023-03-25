<?php
namespace App;

use Auth;

class AuthItem
{
    /**
     * Tests if current user is authorized to view current item.
     * 
     * Calls relationToUser on the item in the case it has no user_id field.
     * 
     * @param Object $item
     * @return bool
     */
    public function isAuthorized($item)
    {
        /*
         * If user_id present in object test against current user's id.
         * Otherwise, get parent object and resubmit.
         */
        if(array_key_exists('user_id', $item['attributes'])){
            return $item->user_id === Auth::user()->id;
        } else {
            $type = $item->relationToUser();
            $nItem = $item->$type;
            return $this->isAuthorized($nItem);
        }
    }
}
<?php

/**
 * Set values of an object from the Request objects inputs.
 * 
 * @param Request $request The request object.
 * @param Object $item The $item to be set.
 * @param string $table The table to query for fields.
 * @return Object
 */
function fillItem($request, $item, $table){
    /*
     * Get common array fields.
     */
    $values = array_intersect_key($request->all(), array_flip(Schema::getColumnListing($table)));
    foreach($values as $key => $value){
        if(!empty($value)){
            $item[$key] = $value;
        }
    }
    return $item;
}

/**
 * Sets object retrieval to the proper id.
 * 
 * If there is more than one argument, the second argument is used.
 * 
 * @param array $args Function arguments.
 * @param string $type The object type to query.
 * @return Object
 */
function retrieveItemFromArgs($args, $type)
{
    $class = "\\App\\" . ucfirst($type);
    return count($args)>1 ? $class::find($args[1]) : 
        $class::find($args[0]);
}
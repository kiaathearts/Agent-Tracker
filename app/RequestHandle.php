<?php
namespace App;

use View;
use Session;

class RequestHandle
{
    /**
     * Check for delete or cancel.
     * 
     * @param Request $request The request object.
     * @param string $type The object type.
     * @param int $id The object id.
     */
    public function checkRequest($request, $type = null, $id = null){
        /*
         * If a type is available, set the class.
         */
        if(!empty($type)){
            $typeclass = 'App\\' . ucfirst($type);
            $typeplural = $type . 's';
        }
        
        /*
         * If cancel requested redirect to type.show if id is provided or type.index.
         */
        if($request->input('cancel')){
            if(!empty($id)) {
                return redirect("$type/{$id}");
            } else {
                $all = $typeclass::all();
                return View::make($type .'.index')->with(array($typeplural => $all));
            }
        } elseif($request->input('delete')) {
            /*
             * If delete is requested, delete object. Return success message.
             */
            if($typeclass::destroy($id)){
                $all = $typeclass::all(); //This must be here, otherwise deleted type will show in index for a request.
                Session::flash('success message', "The {$type} has been successfully removed.");
                return View::make($type . '.index')->with(array($typeplural => $all));
            } else {
                Session::flash('success message', 'The agent was not successfully deleted. Please try again.');
                $typesingle = $typeclass::find($id);
                return View::make($type . '.show')->with(array($type => $typesingle));
            }
        } else {
            return false;
        }
    }  
    
}
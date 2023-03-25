<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortFormRequest;
use Illuminate\Http\Request;
use App\Facades\RequestHandle;
use App\Agenttype;

class AgenttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agenttypes = Agenttype::all();
        return view()->make('agenttype.index')->with(array( 'agenttypes' => $agenttypes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view()->make('agenttype.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Request object validated before function call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShortFormRequest $request)
    {
            
        /*
         * Check for cancel or delete.
         */
        if($return = RequestHandle::checkRequest($request, 'agenttype')){return $return;}
        
        /*
         * Set agent type values.
         */
        $agenttype = fillItem($request, new Agenttype(), 'agenttypes');
        
        /*
         * Store new agent type with success message.
         */
        $success_message = $agenttype->save() ? 'Agent type has been successfully saved!' :
            'Agent type save not successful. Please, try again later.' ;
        session()->flash('success message', $success_message);
        
        return view()->make('agenttype.show')->with(array('agenttype' => $agenttype));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenttype = Agenttype::find($id);
        return view()->make('agenttype.show')->with(array('agenttype' => $agenttype));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenttype = Agenttype::find($id);
        return view()->make('agenttype.edit')->with(array('agenttype' => $agenttype));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShortFormRequest $request, $id)
    {
        /*
         * Check for cancel or delete.
         */
        if($return = RequestHandle::checkRequest($request, 'agenttype', $id)){return $return;}
        
        /*
         * Set agent type variables.
         */
        $agenttype = fillItem($request, Agenttype::find($id), 'agenttypes');
        
        /*
         * Update agent type and return success message.
         */
        $success_message = $agenttype->update() ? 'Agent type has been successfully updated' :
            'Agent type update was not successful. Please, try again.';
        session()->flash('success message', $success_message);
        return view()->make('agenttype.show')->with(array('agenttype' => $agenttype));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Agenttype::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
}

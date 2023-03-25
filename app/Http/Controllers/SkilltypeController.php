<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\RequestHandle;
use App\Http\Requests\ShortFormRequest;
use App\Skilltype;

class SkilltypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skilltypes = Skilltype::all();
        return view()->make('skilltype.index')->with(array('skilltypes' => $skilltypes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view()->make('skilltype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShortFormRequest $request)
    {
        /*
         * Check request for cancel or delete and return correlating redirect.
         */
        if($return = RequestHandle::checkRequest($request, 'skilltype')){return $return;}
        
        /*
         * Set skill values.
         */
        $skilltype = fillItem($request, new Skilltype(), 'skilltypes');
        
        /*
         * Save new skill and return success message.
         */
        if($skilltype->save()){
            session()->flash('success message', 'Skilltype has been successfully saved!');
        }else{
            session()->flash('success message', 'Skilltype has not saved successfully. Please, try again later.');
            $skilltypes = Skilltype::all();
            return view()->make('skilltype.index')->with(array('skilltypes' => $skilltypes));
        }
        
        return view()->make('skilltype.show')->with(array('skilltype' => $skilltype));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $skilltype = Skilltype::find($id);
        return view()->make('skilltype.show')->with(array('skilltype' => $skilltype));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $skilltype = Skilltype::find($id);
        return view()->make('skilltype.edit')->with(array( 'skilltype' => $skilltype ));
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
         * Check request for cancel or delete and return correlating redirect.
         */
        if($return = RequestHandle::checkRequest($request, 'skilltype', $id)){return $return;}
        
        /*
         * Update skill type values.
         */
        $skilltype = fillItem($request, Skilltype::find($id), 'skilltypes');
        
        /*
         * Update skill type and return success message.
         */
        $success_message = $skilltype->update() ? 'Skilltype successfully updated.' :
            'Skilltype updated failed. Please, try again.';
        session()->flash('success message', $success_message);
        return view()->make('skilltype.show')->with(array('skilltype' => $skilltype));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Skilltype::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
    
}

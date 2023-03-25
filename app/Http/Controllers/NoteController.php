<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShortFormRequest;
use App\Note;
use App\Agent;

class NoteController extends Controller
{
    function __construct()
    {
        $this->middleware('iauth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($agentid = false)
    {
        $args = array();
        if($agent = Agent::find($agentid)){
            $notes = $agent->notes;
            $args['agent'] = $agent;
        } else {
            $notes = Note::all();
        }
        $args['notes'] = $notes;
        return view()->make('note.index')->with($args);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view()->make('note.create')->with(array('edit' => false));
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
         * Set note values.
         */
        $note = fillItem($request, new Note(), 'notes');
        
        /*
         * Save note and return success messasge.
         */
        $success_message = $note->save() ? 'Note has been successfully saved.' : 
            'Note save unsucceful. Please, try again.';
        session()->flash('success message', $success_message);
        return view()->make('agent.show')->with(array('agent' => $note->agent));
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Variable number of args based on caller. 
        // There should be a better way to do this.
        $args = func_get_args();
        if(count($args)>1){
            $note = Note::find($args[1]);
        } else {
            $note = Note::find($args[0]);
        }
        return view()->make('note.show')->with(array('note' => $note));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return view()->make('note.edit')->with(array('note' => $note));
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
         * Update note variables.
         */
        $note = fillItem($request, Note::find($id), 'notes');
        
        /*
         * Update note and return success message.
         */
        $success_message = $note->update() ? 'Note has been successfully updated' : 
            'Not update unsuccessful. Please, try again.';
        session()->flash('success message', $success_message);
        return view()->make('agent.show')->with(array('agent' => $note->agent));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $agent = $note->agent;
        $success_message = Note::destroy($id) ? 'Note successfully deleted' :
            'Note deletion not successful. Please, try again.';
        session()->flash('success message', $success_message);
        return view()->make('note.index')->with(array('notes' => $agent->notes));
    }
}

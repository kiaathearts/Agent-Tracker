<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitation;
use App\Term;
use App\Agent;

class SolicitationController extends Controller
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
    public function index()
    {
        $agent = Agent::find(func_get_args()[0]);
        $solicitations = Solicitation::all();
        return view()->make('solicitation.index')->with(array(
            'solicitations' => $solicitations, 
            'agent' => $agent));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $terms = Term::lists('name', 'id')->all();
        $agent = Agent::find(func_get_args()[0]);
        return view()->make('solicitation.create')->with(array(
            'terms' => $terms,
            'agent' => $agent));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * Check request for cancel or delete and return correlating redirect.
         */
        $agentid = $request['agent_id'];
        if($return = $this->checkSolicitationRequest($request, $agentid)){return $return;}
        
        /*
         * Validate input.
         */
        $validator = $this->getSolicitationValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Set soliciation values.
         */
        $solicitation = fillItem($request, new Solicitation(), 'solicitations');
        
        /*
         * Save solicitation and return success message.
         */
        if($solicitation->save()){
            session()->flash('success message', 'Soliciation has been successfully saved!');
        }else{
            session()->flash('success message', 'Solicitation has not saved successfully. Please, try again later.');
            $agent = Agent::find($agentid);
            return view()->make('solicitation.index')->with(array(
                'solicitation'  => $solicitation,
                'agent'         => $agent
                ));
        }
        return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitation = retrieveItemFromArgs(funct_get_args(), 'solicitation');
        return view()->make('solicitation.show')->with(array(
            'solicitation' => $solicitation,
            ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitation = retrieveItemFromArgs(funct_get_args(), 'solicitation');
        $terms = $this->getTermsList();
        return view()->make('solicitation.edit')->with(array(
            'solicitation' => $solicitation,
            'terms' => $terms));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
         * Check request for cancel or delete and return correlating redirect.
         */
        $agentid = $request['agent_id'];
        if($return = $this->checkSolicitationRequest($request, $agentid, $id)){return $return;}
        
        /*
         * Validate input.
         */
        $validator = $this->getSolicitationValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Update solicitation values.
         */
        $solicitation = fillItem($request, Solicitation::find($id), 'solicitations');
        
        /*
         * Update solicitation and return success message.
         */
        $success_message = $solicitation->update() ? 'Solicitation has been successfully updated.':
            'Update unsuccessful. Please, try again.';
        session()->flash('success message', $success_message);    
        
        return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Solicitation::destroy($id)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Validate input and return validation object.
     * 
     * @param Request $request The request object.
     * @return Validator
     */
    private function getSolicitationValidator($request)
    {
        $messages = [
            'date_of.required' => 'Please enter the date you saw or received this solicitation.',
            'date_of.date' => 'The date must be valid and in valid format.',
            'position.require' => 'The position is required.',
        ];
        $validation = [
            'date_of' => 'required|date',
            'position' => 'required',
        ];
        
        return Validator::make($request->all(), $validation, $messages);
    }
    
    /**
     * Check soliciation request for cancel or delete.
     * 
     * @param Request $request The request object.
     * @param int $agentid The correlating agent id.
     * @param int $solicitationid The solicitation id.
     * @return View|bool
     */
    private function checkSolicitationRequest($request, $agentid = null, $solicitationid = null)
    {
        /*
         * If cancel is requested return solicitation view if id provided or return solicitation list view.
         */
        if($request->input('cancel')){
            if(!empty($solicitationid)){
                $solicitation = Solicitation::find($solicitationid);
                return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
            } else {
                $agent = Agent::find($agentid);
                return view()->make('solicitation.index')->with(array('agent' => $agent));
            }
        } elseif($request->input('delete')){
            /*
             * If delete requested and delete successful, return solicitation index. Otherwise,
             * direct back to solicitation's view page.
             */
            if(Solicitation::destroy($solicitationid)){
                session()->flash('success message', 'The solicitation was successfully deleted.');
                $agent = Agent::find($agentid);
                return view()->make('solicitation.index')->with(array('agent' => $agent));
            } else {
                session()->flash('success message', 'Solicitation deletion unsuccessful. Please, try again.');
                $solicitation = Solicitation::find($solicitationid);
                return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
            }
        } else {
            return false;
        }
    }
}

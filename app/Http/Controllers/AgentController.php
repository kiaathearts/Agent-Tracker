<?php

namespace App\Http\Controllers;

use App\Facades\RequestHandle;
use Illuminate\Http\Request;
use App\Agenttype;
use App\Agent;
use App\Note;

class AgentController extends Controller
{
        
    public function __construct(){
        $this->middleware('iauth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $agents = Agent::where('user_id', '=', auth()->user()->id)->get();
        return view()->make('agent.index')->with(array('agents' => $agents));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types_list = Agenttype::lists('name', 'id')->all();
        return view()->make('agent.create', array('types' => $types_list ));
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
         * Check for cancel or delete.
         */
        if($return = RequestHandle::checkRequest($request, 'agent')){return $return;}
        
        /*
         * Validate submission
         */
        $validator = $this->getAgentValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Set new values
         */
        $agent = fillItem($request, new Agent(), 'agents');

        /*
         * If photo is uploaded, set photo file uri. Otherwise, default to Agent Smith.
         */
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $agent->furi = $this->setFile($agent, $request->file('photo'));
        } else {
            $agent->furi = 'uploads/Agent_Smith.jpg';
        }
        
        /*
         * Set the user id
         */
        $agent->user_id = auth()->user()->id;
        
        /*
         * Save agent to database with success message.
         */
        if($agent->save()){
            session()->flash('success message', 'Agent has been successfully created!');
            // View newly saved agent.
            return view()->make('agent.show')->with(array('agent' => $agent));
        }else{
            session()->flash('success message', 'New agent creation unsuccessful. Please, try again later.');
            // View agent list.
            return redirect('agent');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
         * Get agent from database.
         */
        $agent = Agent::find($id);
        
        /*
         * Check that the user is authorized to view this agent.
         */
        if($agent->user_id === auth()->user()->id){
            return view()->make('agent.show')->with(array('agent' => $agent));
        } else {
            return view()->make('agent.none');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*
         * Get agent from database.
         */
        $agent = Agent::find($id);
        /*
         * Retrieve list of agent types.
         */
        $types_list = Agenttype::lists('name', 'id');
        
        return view()->make('agent.edit')
            ->with(array(
            'agent'     => $agent,
            'types'     => $types_list,
            ));
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
         * Check for cancel or delete.
         */
        if($return = RequestHandle::checkRequest($request, 'agent', $id)){return $return;}
        
        /*
         * Validate submission
         */
        $validator = $this->getAgentValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Set agent values for entry.
         */
        $agent = fillItem($request, Agent::find($id), 'agents');
        /*
         * Set new image file uri.
         */
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $agent->uri = $this->setFile($agent, $request->file('photo'));
        }
        
        /*
         * Set user id.
         */
        $agent->user_id = auth()->user()->id;
        
        /*
         * Update agent with success message.
         */
        $successMessage = $agent->update() ? 'Agent has been successfully updated!' :
            'The agent was not successfully updated. Please, try again later.';
        session()->flash('success message', $successMessage);
        return view()->make('agent.show')->with(array('agent' => $agent));
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Agent::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Show notes for the selected agent.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     **/
     public function agentNotes($id)
     {
         $agent = Agent::find($id);
         $notes = $agent->notes;
         return view()->make('note.index')
            ->with(array(
                'notes' => $notes,
                'agent' => $agent));
     }
     
     /**
      * Return a single selected note for the selected agent.
      * 
      * @param int $agentid
      * @param int $noteid
      * @return \Illuminate\Http\Response
      **/
      public function agentNote($agentid, $noteid)
      {
          $agent = Agent::find($agentid);
          $note = $agent->notes()->where('id', $noteid)->first();
          $note = Note::find($notid);
        
          return view()->make('note.show')->with(array('note' => $note ));
      }
      
      private function getAgentValidator($request){
        $messages = [
            'firstName.required' => 'The agent\'s first name is required.' ,
            'lastName.required' => 'The agent\'s last name is required.',
            'agency.required' => 'The agent\'s agency is required.',
            'phone.regex' => 'Please enter a valid phone number using only numbers with or without dashes or parenthesis.',
            'email.required' => 'The agent\'s email is required.',
            'email.email' => 'The agent\'s email must be a valid email format.',
            'photo.agent_image' => 'The agent\'s photo must be an image file. Please, upload jpeg, png, bmp, gif, or svg.',
        ];
        
        $validations = [
            'firstName' => 'required',
            'lastName' => 'required', 
            'agency' => 'required', 
            'phone' => ['regex:/^\(?\d{3}\)?\s?\d{3}\-?\d{4}$/'],
            'email' => 'required|email',
            'photo' => 'agent_image',
        ];
        
        $validator = validator()->make($request->all(), $validations, $messages);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $this->checkFile($validator, $request->file('photo'));
        }
        return $validator;
    }
    
    private function setFile($agent, $file){
        $fileName = "{$agent['firstName']}_{$agent['lastName']}_{$agent['agency']}.". $file->getClientOriginalExtension(); 
        $fileName = str_replace(" ", "_", $fileName);
        $filePath = public_path().'/uploads';
        $file->move($filePath, $fileName);
        return 'uploads/'.$fileName;
    }
    
    private function checkFile($validator, $file){
        $validator->addExtension('agent_image', function ($attribute, $value, $parameters, $validator) use($file){
            $valid = ['image/jpg', 'image/jpeg', 'image/bmp', 'image/png', 'image/gif'];
            return in_array($file->getMimeType(), $valid);
        });
    }
    
    function agentSearch(Request $request)
    {
        $firstName = $request['agent-search-first-name'];
        $lastName = $request['agent-search-last-name'];
        $location = $request['agent-search-location'];
        $agency = $request['agent-search-agency'];
        $email = $request['agent-search-email'];
        $phone = $request['agent-search-phone'];

        $groups = Agent::whereOrWithout('firstName', 'LIKE', "%$firstName%" )
            ->whereOrWithout('lastName', 'LIKE', "%$lastName%")
            ->whereOrWithout('location','LIKE', "%$location%")
            ->whereOrWithout('agency', 'LIKE', "%$agency%")
            ->whereOrWithout('email', 'LIKE', "%$email%")
            ->whereOrWithout('phone', 'LIKE', "%$phone%")
            ->orderBy('agency', 'asc')
            ->orderBy('location', 'asc')
            ->orderBy('lastName', 'asc')
            ->orderBy('firstName', 'asc')
            ->get();
            
        return view()->make('agent.results')->with(array('groups' => $groups));
    }
}

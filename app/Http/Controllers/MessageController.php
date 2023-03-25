<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Agent;
use Schema;

class MessageController extends Controller
{
    public function __construct()
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
        $messages = Message::where('user_id', '=', auth()->user()->id)->get();
        return view()->make('message.index')->with(array('messages' => $messages));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->getMessageTags();
        return view()->make('message.create')->with(array('tags' => $tags));
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
         * Check for cancel or delete request.
         */
        if($return = $this->checkMessageRequest($request)){return $return;}
        
        /*
         * Validate request.
         */
        $validator = $this->getMessageValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Set message values.
         */
        $message = fillItem($request, new Message(), 'messages');
        $message->user_id = auth()->user()->id;
        
        /*
         * Save new message and return success message.
         */
        if($message->save()){
            session()->flash('success message', 'Message has been successfully saved!');
            return view()->make('message.show')->with(array('message' => $message));
        }else{
            $messages = Message::all();
            $tags = $this->getMessageTags();
            session()->flash('success message', 'Message save unsuccessful. Please, try again later.');
            return view()->make('message.index')->with(array(
                'messages' => $messages,
                'tags' => $tags));
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
        $message = Message::find($id);
        return view()->make('message.show')->with(array('message' => $message));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = $this->getMessageTags();
        $message = Message::find($id);
        return view()->make('message.edit')->with(array(
            'message' => $message, 
            'tags' => $tags));
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
         * Check for cancel or delete request.
         */
        if($return = $this->checkMessageRequest($request, $id)){return $return;}
        
        /*
         * Validate input.
         */
        $validator = $this->getMessageValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Set message values.
         */
        $message = fillItem($request, Message::find($id), 'messages');
        
        /*
         * Update message and return success message.
         */ 
        $success_message = $message->update() ? 'Message has been successfully edited' :
            'Message update unsuccessful. Please, try again';
        session()->flash('success message', $success_message);
        return view()->make('message.show')->with(array('message' => $message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Message::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Check request for cancel or delete.
     * 
     * Redirects to correlating request. Returns false if neither delete or cancel.
     * 
     * @param Request $request The request object.
     * @param int $id The id of the message if delete.
     * @return Request|Boolean
     */
    private function checkMessageRequest($request, $id = null)
    {
        if($request->input('cancel')){
            /*
             * If cancel request and id, go redirect to message. Otherwise, go to index.
             */
            if(!empty($id)) {
                return redirect("message/{$id}");
            } else {
                $messages = Message::all();
                return view()->make('message.index')->with(array('messages' => $messages));
            }
        } elseif($request->input('delete')) {
            /*
             * If successful delete return a redirect to list. Otherwise, return a redirect to message.
             * Return a success message.
             */
            $success = Message::destroy($id);
            if($success){
                $messages = Message::all(); //This must be here, otherwise deleted type will show in index for a request.
                session()->flash('success message', "The message has been successfully removed.");
                return view()->make('message.index')->with(array('messages' => $messages));
            } else {
                session()->flash('success message', 'Message delete unsuccessful. Please try again.');
                $message = Message::find($id);
                return view()->make('message.show')->with(array('message' => $message));
            }
        } else {
            return false;
        }
    }
    
    /**
     * Validate request object and return validator.
     * 
     * @param Request $request The request object to validate.
     * @return Validator The new vailidation object.
     */
    private function getMessageValidator($request)
    {
        $messages = [
            'name.required' => 'Please enter a name for the message',
            'message.required' => 'Please enter a text to send within the message body.',
            'name.regex' => 'The message name cannot include the characters \'*\' and \'\\\'',
            'message.regex' => 'The message name cannot include the characters \'*\' and \'\\\'',
            ];
        $validation = [
            'name' => 'required|regex:#.*[^*\\\]#',
            'message' => 'required|regex:#.*[^*\\\]#',
            ];
        return validator()->make($request->all(), $validation, $messages);
    }
    
    /**
     * Create and return a list of valid tags for use in message.
     * 
     * @return array $tags.
     */
    private function getMessageTags(){
        /*
         * Retrieve fields from messages table.
         */
        $properties = Schema::getColumnListing('agents');
        $doNotList = ['created_at', 'updated_at', 'furi', 'id', 'agenttype_id'];
        
        /*
         * Set tags with omitted options.
         */
        $tags = array();
        foreach($properties as $property){
            if(!in_array($property, $doNotList)){
                $tags[] = $property;
            }
        }
        return $tags;
    }
    
    /**
     * Search database for a requested message.
     * 
     * @param Request $request.
     * @return View The message search results page.
     */
    function messageSearch(Request $request)
    {
        $name = $request['search-message-name'];
        $body = $request['search-message-body'];
        
        $messages = Message::where('name', 'LIKE', "%$name%" )
            ->where('message', 'LIKE', "%$body%")
            ->orderBy('name', 'asc')
            ->get();
        
        return view()->make('message.results')->with(array('messages' => $messages));
    }
}

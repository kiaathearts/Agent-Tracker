<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Agent;
use Mail; //Maybe not necessary.

class BatchSenderController extends Controller
{
    /**
     * Send out bulk email
     * 
     * Converts tags in each message before sending out to designated recipients.
     * 
     * @param Request $request The list of agents to whom to send the emails.
     */
    function postBatchSend(Request $request)
    {
        
        /*
         * Get tag creator and tag converter.
         */
        $tagger = app()->make('App\Contracts\Message\TextTag');
        $converter = app()->make('App\Contracts\Message\Conversion');
        
        /*
         * Convert tags in each message.
         */
        $tags = $tagger->tags('agents', 'App\Agent', $request->input('agents'));
        $messageObj = Message::find($request->input('messageid'));
        foreach($tags as $tag => $value){
            $messages[$tag] = $converter->convertTags($value, $messageObj->message);
        }
        
        $agents = Agent::find($request->input('agents'));
        
        /*
         * Set emails to be sent.
         */
        $emails = array();
        foreach($agents as $agent){
            $emails[$agent->id]['email'] = $agent->email;
            $emails[$agent->id]['message'] = $messages[$agent->id];
            mail()->send('email.notification', array('message' => $messages[$agent->id]), function($email) use($agent){
               $email->from('nme@nekiagoode.com')
               ->to($agent->email, "{$agent->firstName} {$agent->lastName}")
               ->subject('This is a test email'); 
            });
        }
        
        
        var_dump($emails);
    }
}

<?php
namespace App;


use App;

class AgentMessager
{
    /**
     * Returns a list of converted messages for selected agents.
     * 
     * @param string $message The message to convert.
     * @param array $ids The agent ids to query.
     * @return array $messages An array of converted messages keyed by the correlating agent id.
     **/
    function listMessages($message, $ids = array()){
        //The tag creation variable.
        $tagger = App::make('App\Contracts\Message\TextTag');
        $ids = $tagger->tags('agents', 'App\Agent');
        //The tag converter variable.
        $converter = App::make('App\Contracts\Message\Conversion');
        
        //Populate an array of converted messages.
        $messages = array();
        foreach($ids as $id => $tags){
            $messages[$id] = $converter->convertTags($tags, $message);
        }
        return $messages;
    }
}

<?php

namespace App;

use App\Contracts\Message\Conversion;

class MessageConverter implements Conversion
{
    public function convertTags($tags, $text){
        foreach($tags as $tag => $value){
            $text = str_replace("[$tag]", $value, $text);
        }
        return $text;
    }
}
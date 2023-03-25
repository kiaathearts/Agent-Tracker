<?php
namespace App\Contracts\Message;

interface Conversion
{
    /**
     * Convert tags in a text to their respective values.
     * 
     * @param array $tags
     * @param text $text
     * 
     * @return text $convertedText
     **/
   public function convertTags($tags, $text);
}
<?php
namespace App\Contracts\Message;

interface TextTag
{   
    /**
     * Provide model tags and correlating database fields.
     * 
     * @param string $table
     * @return array $tags
     **/
    public function tags($table, $model, $condition);
}
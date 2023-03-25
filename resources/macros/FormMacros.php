<?php
    Form::macro('agentcheckbox', function($agent){
        return '<input type="checkbox" name="agents[]" value="{$agent->id}"> {$agent->firstName} {$agent->lastName}';
    });
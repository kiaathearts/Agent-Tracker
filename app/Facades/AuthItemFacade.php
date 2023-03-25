<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AuthItem extends Facade
{
    protected static function getFacadeAccessor(){return 'authItem';}
}
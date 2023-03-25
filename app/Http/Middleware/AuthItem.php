<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\AuthItem as AItem;
use View;

class AuthItem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        $pattern = '/(.*)?\/(\d+)?\/(.*)\/(\d+)\/(.*)/';
        if(preg_match($pattern, $path, $matches)){
            $classname = array_key_exists(3, $matches) ? $matches[3] : $matches[1];
            $itemid = array_key_exists(4, $matches) ? $matches[4] : $matches[2];
            
            $class = "\\App\\". ucfirst(str_singular($classname));
            $item = $class::find($itemid);
            
            if(!empty($item) && AItem::isAuthorized($item)){
                return $next($request);
            } else {
                $route = $classname . '.none';
                return View::make($route);
            }
        }
        
        return $next($request);
        
    }
}

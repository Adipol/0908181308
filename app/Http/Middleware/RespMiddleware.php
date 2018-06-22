<?php

namespace App\Http\Middleware;

use Closure;
use App\Associate;

class RespMiddleware
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
        $value              = session()->get('warehouse_id');
        $user               = auth()->user()->id;
        
        $warehouse          = Associate::where('warehouse_id',$value)->where('user_id',$user)->first();
        
        if($warehouse){
            $condition = $warehouse->condition;
        }
        else{
            $condition = 0;
        }

        if (auth()->check() && auth()->user()->rol_id == (int) 4 && $condition == (int) 1) {
            return $next($request);
        }	
        	
		return redirect()->guest('/');
    }
}

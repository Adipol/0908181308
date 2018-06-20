<?php

namespace App\Http\Middleware;

use Closure;
use App\Associate;

class SolMiddleware
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
        $condition = $warehouse->condition;

        if (auth()->check() && auth()->user()->rol_id == (int) 2 && $condition == (int) 1) {
            return $next($request);
        }	
        	
		return redirect()->guest('/');
    }
}

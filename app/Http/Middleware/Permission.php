<?php

namespace App\Http\Middleware;

use Closure;

class Permission
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
        if (auth('api')->user()->user_type_id == 1 || auth('api')->user()->user_type_id == 2) {
             return $next($request);
        }
        if (auth('api')->user()->user_type_id == 3) {
             return response()->json(['data' => 'user without permission!']);
        }
       
    }
}

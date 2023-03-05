<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class JsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //$request->header('Content-Type') == 'application/json'
        
        if ($request->header('Content-Type') != 'application/json') 
        {
            return response()->json([
                'success'=> 'false',
                'message' => 'Do not have authorization'
            ], 404);   
        }
        
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Auth;

class Abogado
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
        if ($request->user()->role_id != 2 || $request->user()->role->status == 0) {
            return response()->json([
                'resp' => false,
                'msg' => 'Acceso no autorizado',
            ], 401);
        }
        return $next($request);
    }
}

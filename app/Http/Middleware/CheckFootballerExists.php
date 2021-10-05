<?php

namespace App\Http\Middleware;

use App\Models\Footballer;
use Closure;
use Illuminate\Http\Request;

class CheckFootballerExists
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
        $id = $request->route('id');
        Footballer::findOrFail($id);
        return $next($request);
    }
}

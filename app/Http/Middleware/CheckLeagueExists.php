<?php

namespace App\Http\Middleware;

use App\Models\League;
use Closure;
use Illuminate\Http\Request;

class CheckLeagueExists
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
        League::findOrFail($id);
        return $next($request);
    }
}

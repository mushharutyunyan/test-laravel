<?php

namespace App\Http\Middleware;

use App\Models\Coach;
use Closure;
use Illuminate\Http\Request;

class CheckCoachExists
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
        Coach::findOrFail($id);
        return $next($request);
    }
}

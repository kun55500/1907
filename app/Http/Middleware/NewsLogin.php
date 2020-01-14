<?php

namespace App\Http\Middleware;

use Closure;

class NewsLogin
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
        $user=session('admin');
        if(!$user){
            return redirect('/login');
        }
        return $next($request);
    }
}

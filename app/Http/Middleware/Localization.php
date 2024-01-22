<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(\Session::get('locale'));
        
        if (\Session::has('locale')) {
            //dd("dd");
            \App::setLocale(\Session::get('locale'));
        }

        return $next($request);
    }
}

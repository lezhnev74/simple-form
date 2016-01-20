<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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

        $allowed_locales = ['en','fr'];
        if(in_array($request->input('locale'), $allowed_locales)) {
            \App::setLocale($request->input('locale'));
        }

        return $next($request);
    }
}

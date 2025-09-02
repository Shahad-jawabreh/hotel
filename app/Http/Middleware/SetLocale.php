<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $lang = $request->query('lang', config('app.locale'));
        App::setLocale($lang);

        return $next($request);
    }
}

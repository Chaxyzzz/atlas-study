<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    /**
     * Handle an incoming request and set active application locale
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = 'id';

        if (Auth::check() && !empty(Auth::user()->preferred_language)) {
            $locale = Auth::user()->preferred_language;
        } elseif (session()->has('locale')) {
            $locale = session('locale');
        } elseif ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
        }

        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        App::setLocale($locale);

        return $next($request);
    }
}

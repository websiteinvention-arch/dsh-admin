<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotWebsite
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('website_id')) {
            return redirect()->route('website.login');
        }

        return $next($request);
    }
}
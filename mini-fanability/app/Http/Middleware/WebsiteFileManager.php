<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebsiteFileManager
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('website_id')) {
            return redirect()->route('website.login');
        }

        return $next($request);
    }
}
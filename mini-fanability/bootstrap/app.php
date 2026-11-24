<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\WebsiteFileManager;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'nocache' => \App\Http\Middleware\NoCache::class,
            'admin.auth' => \App\Http\Middleware\RedirectIfNotAdmin::class,
            'super.admin' => \App\Http\Middleware\EnsureSuperAdmin::class,
            'website.auth' => \App\Http\Middleware\RedirectIfNotWebsite::class,
            'website.filemanager' => WebsiteFileManager::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



    
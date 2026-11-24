<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Entity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('website.partials.sidebar', function ($view) {

        $websiteId = Session::get('website_id');

        $sidebarEntities = Entity::where('website_id', $websiteId)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $view->with('sidebarEntities', $sidebarEntities);
        });
    }
}

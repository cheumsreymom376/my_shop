<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        // Make the category list available to the navbar dropdown
        // on every page, without every controller needing to pass it.
        View::composer('layouts.app', function ($view) {
            $view->with('navCategories', Category::where('is_active', true)->get());
        });
    }
}
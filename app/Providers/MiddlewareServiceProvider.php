<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Register middleware directly
        Route::aliasMiddleware('admin', AdminMiddleware::class);
    }
}
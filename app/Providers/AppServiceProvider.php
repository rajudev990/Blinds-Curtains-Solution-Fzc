<?php

namespace App\Providers;

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // parent::boot();

        // Register the middleware
        $this->app['router']->aliasMiddleware('permission', CheckPermission::class);
        Paginator::useBootstrapFive(); // Use Bootstrap 5 styling
    }
}

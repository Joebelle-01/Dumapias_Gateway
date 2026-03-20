<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Passport's default route registration assumes Laravel's router, which Lumen doesn't provide.
        // We'll define the needed OAuth endpoints in `routes/web.php` instead.
        Passport::ignoreRoutes();
    }
}

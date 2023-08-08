<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IsFriendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/FormatTime.php';

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

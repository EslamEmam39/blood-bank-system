<?php

namespace App\Providers;

use App\Models\setting;
use Illuminate\Pagination\Paginator;
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
            Paginator::useBootstrapFive(); // أو useBootstrapFour لو بتستخدم Bootstrap 4

            $settings = setting::first();

            view()->share(compact('settings'));

    }
}

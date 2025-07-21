<?php

namespace App\Providers;

use App\Models\setting;
use Illuminate\Auth\Middleware\Authenticate;
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

    Authenticate::redirectUsing(function ($request) {
        // لو الراوت فيه prefix client أو في صفحات العميل
        if ($request->is('client/*') || $request->routeIs('client.*')) {
            return route('client.login'); // صفحة تسجيل دخول العميل
        }

        return route('login'); // صفحة تسجيل دخول الأدمن
    });



            Paginator::useBootstrapFive(); // أو useBootstrapFour لو بتستخدم Bootstrap 4
            $settings = setting::first();
            view()->share(compact('settings'));

    }
}

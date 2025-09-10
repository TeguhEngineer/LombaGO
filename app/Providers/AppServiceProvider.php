<?php

namespace App\Providers;

use App\Models\Informasi;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        View::composer('layouts.navbar', function ($view) {
            $data = Informasi::latest()->get();
            $view->with('info', $data);
        });
        
        Gate::define('superadmin', function ($user) {
            return $user->role === 'superadmin';
        });

        Gate::define('user', function ($user) {
            return $user->role === 'user';
        });

        Paginator::useBootstrap();
    }
}

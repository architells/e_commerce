<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $unreadCount = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
            $view->with('unreadCount', $unreadCount);
        });
    }
}

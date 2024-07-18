<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('minute', function ($attribute, $value, $parameters) {
            $minutes = (int) date('i', strtotime($value));
            return in_array($minutes, [0, 30]);
        });
    }
}

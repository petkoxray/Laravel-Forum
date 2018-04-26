<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view) {
            $channels = \Cache::rememberForever('channels', function () {
                return Channel::all();
            });
            $view->with('channels', $channels);
        });

        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');

        \Blade::if('role', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

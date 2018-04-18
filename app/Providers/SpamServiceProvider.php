<?php

namespace App\Providers;

use App\Utils\Spam\SpamService;
use Illuminate\Support\ServiceProvider;

class SpamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Utils\Spam\SpamService', function ($app) {
            return new SpamService();
        });
    }
}

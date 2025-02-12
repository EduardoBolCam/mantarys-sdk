<?php

namespace DevDizs\MantarysSdk;

use Illuminate\Support\ServiceProvider;

class MantarysServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Merge the package configuration with the application's published configuration.
        $this->mergeConfigFrom(
            __DIR__.'/../config/mantarys.php', 'mantarys'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Publish the configuration file.
        $this->publishes([
            __DIR__.'/../config/mantarys.php' => config_path('mantarys.php'),
        ], 'mantarys-config'); // Use 'config' as the tag for publishing.
    }
}
<?php

namespace MadWeb\Enum;

use Illuminate\Support\ServiceProvider;

class EnumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Config
        $this->publishes([
            __DIR__.'/../config/enum.php' => config_path('enum.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/enum.php', 'enum');
    }
}

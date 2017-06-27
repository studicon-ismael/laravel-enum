<?php

namespace ZFort\Skeleton;

use Illuminate\Support\ServiceProvider;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerResources();
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'skeleton');
    }

    /**
     * Register package resources.
     */
    protected function registerResources()
    {
        // Config
        $this->publishes([
            __DIR__.'/../config/skeleton.php' => config_path('skeleton.php'),
        ], 'config');

        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'skeleton');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/skeleton'),
        ], 'views');

        // Database
        if (! class_exists('CreateSocialProvidersTable')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/migrations/create_skeleton_table.php.stub' => $this->app->databasePath().'/migrations/'.$timestamp.'_create_skeleton_table.php',
            ], 'migrations');
        }

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'skeleton');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/social-auth'),
        ], 'lang');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
    }
}

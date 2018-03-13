<?php

namespace Stylers\Laratask\Providers;


use Illuminate\Support\ServiceProvider;
use Stylers\Laratask\Commands\TaskGeneratorCommand;

/**
 * Class LarataskServiceProvider
 * @package Stylers\Laratask\Providers
 */
class LarataskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../config' => config_path(),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                TaskGeneratorCommand::class
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(LarataskEventServiceProvider::class);
    }
}
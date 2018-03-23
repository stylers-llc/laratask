<?php

namespace Stylers\Laratask\Providers;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Stylers\Laratask\Console\Commands\TaskGeneratorCommand;

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

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command(TaskGeneratorCommand::class)->daily(); // Run the task every day at midnight
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(TaskGeneratorCommand::class);

        $this->app->register(LarataskEventServiceProvider::class);
        $this->app->register(LarataskObserverServiceProvider::class);
    }
}
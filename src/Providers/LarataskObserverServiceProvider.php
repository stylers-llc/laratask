<?php

namespace Stylers\Laratask\Providers;

use Illuminate\Support\ServiceProvider;
use Stylers\Laratask\Models\TaskTemplateTaskRuntime;
use Stylers\Laratask\Observers\TaskTemplateTaskRuntimeObserver;

class LarataskObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TaskTemplateTaskRuntime::observe(TaskTemplateTaskRuntimeObserver::class);
    }
}
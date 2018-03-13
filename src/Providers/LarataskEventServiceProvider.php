<?php

namespace Stylers\Laratask\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use \Stylers\Laratask\Events\CheckTaskTemplateEvent;
use \Stylers\Laratask\Listeners\CheckAndGenerateTasks;

class LarataskEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        CheckTaskTemplateEvent::class => [
            CheckAndGenerateTasks::class
        ]
    ];
}
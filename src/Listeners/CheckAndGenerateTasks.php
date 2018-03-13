<?php

namespace Stylers\Laratask\Listeners;


use Stylers\Laratask\Events\CheckTaskTemplateEvent;
use Illuminate\Support\Facades\Config;

class CheckAndGenerateTasks
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Handle the event.
     *
     * @param CheckTaskTemplateEvent $event
     * @return void
     */
    public function handle(CheckTaskTemplateEvent $event)
    {
        var_dump($event->taskTemplate);
    }
}
<?php

namespace Stylers\Laratask\Listeners;


use Stylers\Laratask\Events\CheckTaskTemplateEvent;
use Stylers\Laratask\Generators\TaskGenerator;

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
        $generator = new TaskGenerator($event->taskTemplate);
        $generator->generate();
    }
}
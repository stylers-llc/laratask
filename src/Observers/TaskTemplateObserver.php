<?php

namespace Stylers\Laratask\Observers;


use Stylers\Laratask\Models\TaskTemplate;

class TaskTemplateObserver
{
    public function creating(TaskTemplate $taskTemplate)
    {
        dd('taskTemplateObserver');
    }
}
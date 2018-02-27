<?php

namespace Stylers\Laratask\Models\Traits;

use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;

trait Taskable
{
    public function taskedTaskTemplates()
    {
        return $this->morphMany(TaskTemplate::class, 'taskable');
    }

    public function taskedTasks()
    {
        return $this->hasManyThrough(
            Task::class,
            TaskTemplate::class,
            'taskable_id',
            'task_template_id'
        );
    }
}
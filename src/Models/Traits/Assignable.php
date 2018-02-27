<?php

namespace Stylers\Laratask\Models\Traits;

use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;

trait Assignable
{
    public function assignedTaskTemplates()
    {
        return $this->morphMany(TaskTemplate::class, 'assignable');
    }

    public function assignedTasks()
    {
        return $this->hasManyThrough(
            Task::class,
            TaskTemplate::class,
            'assignable_id',
            'task_template_id'
        );
    }
}
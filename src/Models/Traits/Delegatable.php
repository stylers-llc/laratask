<?php

namespace Stylers\Laratask\Models\Traits;

use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;

trait Delegatable
{
    public function delegatedTaskTemplates()
    {
        return $this->morphMany(TaskTemplate::class, 'delegatable');
    }

    public function delegatedTasks()
    {
        return $this->hasManyThrough(
            Task::class,
            TaskTemplate::class,
            'delegatable_id',
            'task_template_id'
        );
    }
}
<?php

namespace Stylers\Laratask\Models\Traits;


use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;

/**
 * Trait Taskable
 * @package Stylers\Laratask\Models\Traits
 */
trait Taskable
{
    /**
     * @return MorphMany
     */
    public function taskedTaskTemplates()
    {
        return $this->morphMany(TaskTemplate::class, 'taskable');
    }

    /**
     * @return HasManyThrough
     */
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
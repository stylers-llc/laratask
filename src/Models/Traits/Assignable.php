<?php

namespace Stylers\Laratask\Models\Traits;


use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;

/**
 * Trait Assignable
 * @package Stylers\Laratask\Models\Traits
 */
trait Assignable
{
    /**
     * @return MorphMany
     */
    public function assignedTaskTemplates()
    {
        return $this->morphMany(TaskTemplate::class, 'assignable');
    }

    /**
     * @return HasManyThrough
     */
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
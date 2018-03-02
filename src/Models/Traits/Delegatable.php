<?php

namespace Stylers\Laratask\Models\Traits;


use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;

/**
 * Trait Delegatable
 * @package Stylers\Laratask\Models\Traits
 */
trait Delegatable
{
    /**
     * @return MorphMany
     */
    public function delegatedTaskTemplates()
    {
        return $this->morphMany(TaskTemplate::class, 'delegatable');
    }

    /**
     * @return HasManyThrough
     */
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
<?php

namespace Stylers\Laratask\Models\Traits;

use Stylers\Laratask\Models\Task;

trait Executable
{
    public function executedTasks()
    {
        return $this->morphMany(Task::class, 'executable');
    }
}
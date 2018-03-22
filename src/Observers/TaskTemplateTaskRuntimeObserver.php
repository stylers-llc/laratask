<?php

namespace Stylers\Laratask\Observers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplateTaskRuntime;

class TaskTemplateTaskRuntimeObserver
{
    /**
     * @param TaskTemplateTaskRuntime $taskTemplateTaskRuntime
     */
    public function created(TaskTemplateTaskRuntime $taskTemplateTaskRuntime)
    {
        Artisan::call('task:generate');
    }

    /**
     * @param TaskTemplateTaskRuntime $taskTemplateTaskRuntime
     */
    public function deleting(TaskTemplateTaskRuntime $taskTemplateTaskRuntime)
    {
        $taskTemplateRuntime = $taskTemplateTaskRuntime->taskRuntime;
        if ($taskTemplateRuntime) {
            $tasks = $taskTemplateRuntime
                ->tasks()
                ->where('deadline_at', '>', Carbon::now())
                ->whereNull('executed_at')
                ->get();

            if ($tasks) {
                $ids = $tasks->pluck('id')->toArray();
                Task::destroy($ids);
            }
        }
    }
}
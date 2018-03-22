<?php

namespace Stylers\Laratask\Console\Commands;

use Illuminate\Console\Command;
use Stylers\Laratask\Events\CheckTaskTemplateEvent;
use Stylers\Laratask\Models\TaskTemplate;

class TaskGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate next Task events';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $tasks = TaskTemplate::all();
        foreach ($tasks as $task) {
            event(new CheckTaskTemplateEvent($task));
        }
    }
}
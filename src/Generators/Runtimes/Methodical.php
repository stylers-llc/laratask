<?php

namespace Stylers\Laratask\Generators\Runtimes;

use Carbon\Carbon;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;
use Stylers\Laratask\Models\TaskTemplateRuntime;


class Methodical implements RuntimeInterface
{
    /** @var TaskTemplate */
    protected $template;
    /** @var TaskTemplateRuntime */
    protected $runtime;
    /** @var \DateTimeInterface */
    protected $day;

    public function __construct(TaskTemplate $template, TaskTemplateRuntime $runtime, \DateTimeInterface $day) {
        $this->template = $template;
        $this->runtime = $runtime;
        $this->day = $day;
    }

    public function generate() {
        $nextTime = $this->runtime->calculateNextDate($this->day);

        if($nextTime) {
            return [Task::createIfNotExists($this->template, $this->runtime, $nextTime)];
        }

        return [];
    }
}
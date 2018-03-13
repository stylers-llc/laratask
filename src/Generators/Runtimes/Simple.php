<?php

namespace Stylers\Laratask\Generators\Runtimes;

use Stylers\Laratask\Interfaces\RuntimeInterface;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskTemplate;
use Stylers\Laratask\Models\TaskTemplateRuntime;

class Simple implements RuntimeInterface
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
        return [Task::createIfNotExists($this->template, $this->runtime)];
    }
}
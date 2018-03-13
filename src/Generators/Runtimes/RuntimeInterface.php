<?php

namespace Stylers\Laratask\Generators\Runtimes;

use Stylers\Laratask\Models\TaskTemplate;
use Stylers\Laratask\Models\TaskTemplateRuntime;

interface RuntimeInterface
{
    public function __construct(TaskTemplate $template, TaskTemplateRuntime $runtime, \DateTimeInterface $day);
    public function generate();
}
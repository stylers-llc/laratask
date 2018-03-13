<?php

namespace Stylers\Laratask\Events;

use Illuminate\Queue\SerializesModels;
use Stylers\Laratask\Models\TaskTemplate;

class CheckTaskTemplateEvent
{
    use SerializesModels;

    /**
     * @var TaskTemplate
     */
    public $taskTemplate;

    /**
     * Create a new event instance.
     *
     * @param TaskTemplate $template
     */
    public function __construct(TaskTemplate $template)
    {
        $this->taskTemplate = $template;
    }
}
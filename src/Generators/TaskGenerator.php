<?php

namespace Stylers\Laratask\Generators;


use Carbon\Carbon;
use Stylers\Laratask\Generators\Runtimes\Methodical;
use Stylers\Laratask\Generators\Runtimes\Simple;
use Stylers\Laratask\Models\TaskTemplate;

class TaskGenerator
{
    /** @var TaskTemplate */
    protected $template;
    /** @var \DateTimeInterface */
    protected $day;

    public function __construct(TaskTemplate $template, \DateTimeInterface $day = null)
    {
        $this->template = $template;
        $this->day = $day;

        if(is_null($this->day)) {
            $this->day = Carbon::today()->hour(0)->minute(0)->second(0);
        }
    }

    public function generate()
    {
        $actualTasks = [];
        $runtimes = $this->template->getActualTemplateRuntimes($this->day);
        foreach ($runtimes as $runtime) {
            if(is_null($runtime->date_interval)){
                $generator = new Simple($this->template, $runtime, $this->day);
            } else {
                $generator = new Methodical($this->template, $runtime, $this->day);
            }
            $generated = $generator->generate();
            $actualTasks = array_merge($actualTasks, $generated);
        }

        return $actualTasks;
    }
}
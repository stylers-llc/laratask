<?php

namespace Stylers\Laratask\Builders;


use Illuminate\Support\Facades\DB;
use Stylers\Laratask\Interfaces\ExecutableInterface;
use Stylers\Laratask\Interfaces\TaskBuilderInterface;
use Stylers\Laratask\Models\Task;
use Stylers\Laratask\Models\TaskStatus;
use Stylers\Laratask\Models\TaskTemplate;
use Stylers\Laratask\Models\TaskTemplateRuntime;

class TaskBuilder implements TaskBuilderInterface
{
    /**
     * @var Task
     */
    private $task;

    /**
     * @var \DateTimeInterface
     */
    private $deadline_at;

    /**
     * @var \DateTimeInterface
     */
    private $executed_at;

    /**
     * @var TaskTemplate
     */
    private $taskTemplate;

    /**
     * @var TaskTemplateRuntime
     */
    private $taskTemplateRuntime;

    /**
     * @var TaskStatus
     */
    private $status;

    /**
     * @var ExecutableInterface
     */
    private $executable;

    /**
     * TaskBuilder constructor.
     */
    public function __construct()
    {
        $this->task = new Task();
    }

    /**
     * @param Task $task
     */
    public function setTask(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param \DateTimeInterface $deadline_at
     */
    public function setDeadlineAt(\DateTimeInterface $deadline_at)
    {
        $this->deadline_at = $deadline_at;
    }

    /**
     * @param \DateTimeInterface $executed_at
     */
    public function setExecutedAt(\DateTimeInterface $executed_at)
    {
        $this->executed_at = $executed_at;
    }

    /**
     * @param TaskTemplate $taskTemplate
     */
    public function setTaskTemplate(TaskTemplate $taskTemplate)
    {
        $this->taskTemplate = $taskTemplate;
    }

    /**
     * @param TaskTemplateRuntime $taskTemplateRuntime
     */
    public function setTaskTemplateRuntime(TaskTemplateRuntime $taskTemplateRuntime)
    {
        $this->taskTemplateRuntime = $taskTemplateRuntime;
    }

    /**
     * @param TaskStatus $status
     */
    public function setStatus(TaskStatus $status)
    {
        $this->status = $status;
    }

    /**
     * @param ExecutableInterface $executable
     */
    public function setExecutable(ExecutableInterface $executable)
    {
        $this->executable = $executable;
    }

    /**
     * Build Task
     */
    public function build()
    {
        DB::transaction(function () {
            $this->task->deadline_at = $this->deadline_at;
            $this->task->status_tx_id = $this->status->id;
            $this->task->executable()->associate($this->executable);
            $this->task->taskTemplate()->associate($this->taskTemplate);
            $this->task->taskTemplateRuntime()->associate($this->taskTemplateRuntime);

            $this->task->save();
        });
    }
}
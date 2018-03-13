<?php

namespace Stylers\Laratask\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;

/**
 * Class Task
 * @package Stylers\Laratask\Models
 */
class Task extends Model
{
    use SoftDeletes;

    /**
     * Fillable
     * @var array
     */
    protected $fillable = [
        'deadline_at',
        'executed_at',
        'status_tx_id',
        'task_template_id',
        'task_template_runtime_id'
    ];
    /**
     * Attribute Casting
     * @var array
     */
    protected $casts = [
        'deadline_at' => 'date',
        'executed_at' => 'date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskTemplate()
    {
        return $this->belongsTo(TaskTemplate::class, 'task_template_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskTemplateRuntime()
    {
        return $this->belongsTo(TaskTemplateRuntime::class, 'task_template_runtime_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function executable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'status_tx_id');
    }

    public static function createIfNotExists(TaskTemplate $template, TaskTemplateRuntime $runtime, \DateTimeInterface $day = null)
    {
        $deadline = $runtime->start_at->format("Y-m-d H:i:s");
        if($day) {
            $deadline = $day->format("Y-m-d H:i:s");
        }

        $task = Task::where('task_template_id', $template->id)
            ->where('deadline_at', $deadline)
            ->where('task_template_runtime_id', $runtime->id)
            ->first();

        if(is_null($task)) {
            $task = new self();
            $task->task_template_id = $template->id;
            $task->task_template_runtime_id = $runtime->id;
            $task->deadline_at = $deadline;
            $task->status_tx_id = config('laratask.taxonomy.task_statuses.created.id');
            $task->save();
        }

        return $task;
    }
}
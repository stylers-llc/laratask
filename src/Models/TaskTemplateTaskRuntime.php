<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskTemplateTaskRuntime extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_template_tt_runtime';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_template_id',
        'task_template_runtime_id',
        'next_at'
    ];

    /**
     * Disable timestamps (created_at, updated_at, deleted_at) on pivot
     * @var bool
     */
    public $timestamps = false;

    /**
     * Attribute Casting
     * @var array
     */
    protected $casts = [
        'next_at' => 'datetime'
    ];

    public function taskTemplate()
    {
        return $this->hasOne(TaskTemplate::class, 'id', 'task_template_id');
    }

    public function taskRuntime()
    {
        return $this->hasOne(TaskTemplateRuntime::class, 'id', 'task_template_runtime_id');
    }
}
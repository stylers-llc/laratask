<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskTemplateTaskRuntime extends Pivot
{
    use SoftDeletes;

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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taskTemplate()
    {
        return $this->hasOne(TaskTemplate::class, 'id', 'task_template_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taskRuntime()
    {
        return $this->hasOne(TaskTemplateRuntime::class, 'id', 'task_template_runtime_id');
    }

    /**
     * @return string
     */
    public function getCreatedAtColumn()
    {
        return 'created_at';
    }

    /**
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
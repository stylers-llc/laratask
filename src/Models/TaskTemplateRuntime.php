<?php

namespace Stylers\Laratask\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaskTemplateRuntime
 * @package Stylers\Laratask\Models
 */
class TaskTemplateRuntime extends Model
{
    use SoftDeletes;

    /**
     * Fillable
     * @var array
     */
    protected $fillable = [
        'start_at',
        'end_at',
        'exclude_start_date',
        'date_interval',
    ];
    /**
     * Attribute Casting
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'exclude_start_date' => 'bool',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taskTemplates()
    {
        return $this->belongsToMany(TaskTemplate::class, 'task_template_tt_runtime');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_template_runtime_id');
    }
}
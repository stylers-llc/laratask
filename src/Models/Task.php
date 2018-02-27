<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    ];
    /**
     * Attribute Casting
     * @var array
     */
    protected $casts = [
        'deadline_at' => 'date',
        'executed_at' => 'date',
    ];

    public function taskTemplate()
    {
        return $this->belongsTo(TaskTemplate::class, 'task_template_id');
    }

    public function executable()
    {
        return $this->morphTo();
    }
}
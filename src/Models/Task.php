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
        'task_template_id'
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

    public function status()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'status_tx_id');
    }
}
<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Models\Traits\TxTranslatable;

/**
 * Class TaskRuntime
 * @package Stylers\Laratask\Models
 */
class TaskTemplateRuntime extends Model
{
    use SoftDeletes;
    use TxTranslatable;

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

    public function name()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'name_tx_id');
    }

    public function taskTemplates()
    {
        return $this->belongsToMany(TaskTemplate::class, 'task_template_tt_runtime');
    }
}
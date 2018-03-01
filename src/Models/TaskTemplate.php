<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Description;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Models\Traits\TxTranslatable;

class TaskTemplate extends Model
{
    use SoftDeletes;
    use TxTranslatable;

    /**
     * Fillable
     * @var array
     */
    protected $fillable = [
        'name_tx_id',
        'description_id'
    ];

    public function name()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'name_tx_id');
    }

    public function description()
    {
        return $this->hasOne(Description::class, 'id', 'description_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_template_id');
    }

    public function taskRuntimes()
    {
        return $this->belongsToMany(TaskTemplateRuntime::class, 'task_template_tt_runtime');
    }

    public function delegatable()
    {
        return $this->morphTo();
    }

    public function assignable()
    {
        return $this->morphTo();
    }

    public function taskable()
    {
        return $this->morphTo();
    }
}
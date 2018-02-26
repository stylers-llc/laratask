<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Description;
use Stylers\Taxonomy\Models\Taxonomy;

class TaskTemplate extends Model
{
    use SoftDeletes;

    /**
     * Fillable
     * @var array
     */
    protected $fillable = [

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
        return $this->belongsToMany(TaskRuntime::class, 'task_template_task_runtime');
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
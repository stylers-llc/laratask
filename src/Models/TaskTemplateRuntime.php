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
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->start_at->format('Y-m-d H:i') . ' ' . trans('date_interval.' . $this->date_interval);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taskTemplates()
    {
        return $this->belongsToMany(TaskTemplate::class, 'task_template_tt_runtime');#->using(TaskTemplateTaskRuntime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_template_runtime_id');
    }

    public function calculateNextDate(\DateTimeInterface $day) {
        $nextDate = clone $this->start_at;

        if($this->start_at >= $day) {
            if(!$this->exclude_start_date) {
                return $nextDate;
            }

            $nextDate->add(new \DateInterval($this->date_interval));

            if($this->end_at >= $nextDate) {
                return $nextDate;
            }

            return null;
        }

        if($this->end_at && $this->end_at < $day) {
            return null;
        }

        while($day->format('U') >= $nextDate->format('U')) {
            $nextDate->add(new \DateInterval($this->date_interval));
        }

        return $nextDate;
    }
}
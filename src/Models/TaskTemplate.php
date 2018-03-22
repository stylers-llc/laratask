<?php

namespace Stylers\Laratask\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function name()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'name_tx_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function description()
    {
        return $this->hasOne(Description::class, 'id', 'description_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_template_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taskTemplateRuntimes()
    {
        return $this->belongsToMany(TaskTemplateRuntime::class, 'task_template_tt_runtime');#->using(TaskTemplateTaskRuntime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function delegatable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function assignable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taskable()
    {
        return $this->morphTo();
    }

    public function getActualTemplateRuntimes(\DateTimeInterface $day = null)
    {
        if (is_null($day)) {
            $day = Carbon::today()->hour(0)->minute(0)->second(0);
        }

        $day = $day->format("Y-m-d");

        $singles = DB::table('task_template_tt_runtime')
            ->select('task_template_runtime_id')
            ->join(
                'task_template_runtimes',
                function ($join) use ($day) {
                    $join->on(
                        'task_template_tt_runtime.task_template_runtime_id',
                        '=',
                        'task_template_runtimes.id'
                    );
                    $join->whereNull('task_template_runtimes.date_interval');
                    $join->where('task_template_runtimes.start_at', '>=', $day);
                }
            )
            ->where('task_template_id', $this->id);

        $infinites = DB::table('task_template_tt_runtime')
            ->select('task_template_runtime_id')
            ->join(
                'task_template_runtimes',
                function ($join) use ($day) {
                    $join->on(
                        'task_template_tt_runtime.task_template_runtime_id',
                        '=',
                        'task_template_runtimes.id'
                    );
                    $join->whereNotNull('task_template_runtimes.date_interval');
                    $join->whereNull('task_template_runtimes.end_at');
                }
            )
            ->where('task_template_id', $this->id);

        $methodicals = DB::table('task_template_tt_runtime')
            ->select('task_template_runtime_id')
            ->join(
                'task_template_runtimes',
                function ($join) use ($day) {
                    $join->on(
                        'task_template_tt_runtime.task_template_runtime_id',
                        '=',
                        'task_template_runtimes.id'
                    );
                    $join->whereNotNull('task_template_runtimes.date_interval');
                    $join->where('task_template_runtimes.end_at', '>=', $day);
                }
            )
            ->where('task_template_id', $this->id);

        $query = $methodicals
            ->union($singles)
            ->union($infinites);

        $runtimeIds = $query->pluck('task_template_runtime_id');


        return TaskTemplateRuntime::whereIn('id', $runtimeIds)->get();
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function syncTaskTemplateRuntimes(array $ids)
    {
        $taskTemplateTaskRuntimes = TaskTemplateTaskRuntime::where('task_template_id', $this->id)
            ->whereNotIn('task_template_runtime_id', $ids)
            ->get();

        if ($taskTemplateTaskRuntimes) {
            TaskTemplateTaskRuntime::destroy($taskTemplateTaskRuntimes->pluck('id')->toArray());
        }

        foreach ($ids as $id) {
            TaskTemplateTaskRuntime::updateOrCreate([
                'task_template_id' => $this->id,
                'task_template_runtime_id' => $id,
            ]);
        }

        return $this->taskTemplateRuntimes;
    }
}
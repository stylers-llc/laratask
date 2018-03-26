<?php

use Stylers\Laratask\Enums\TaskTemplateRuntimeInterval;
use Stylers\Laratask\Support\DateInterval;
use Faker\Generator as Faker;
use Stylers\Laratask\Models\TaskTemplateRuntime;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(TaskTemplateRuntime::class, function (Faker $faker) {
    $taskTemplateRuntimeIntervals = TaskTemplateRuntimeInterval::getConstants();
    $intervalString = $taskTemplateRuntimeIntervals[array_rand($taskTemplateRuntimeIntervals)];
    $startAt = Carbon::now();
    $endAt = null;

    if ($intervalString) {
        $endAt = clone $startAt;
        $endAt->add(new DateInterval($intervalString));
    }

    return [
        'start_at' => $startAt,
        'end_at' => $endAt,
        'exclude_start_date' => false,
        'date_interval' => $intervalString,
    ];
});
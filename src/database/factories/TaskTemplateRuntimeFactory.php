<?php

use Stylers\Laratask\Enums\TaskTemplateRuntimeInterval;
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

    return [
        'start_at' => Carbon::now(),
        'end_at' => null,
        'exclude_start_date' => false,
        'date_interval' => $taskTemplateRuntimeIntervals[array_rand($taskTemplateRuntimeIntervals)],
    ];
});
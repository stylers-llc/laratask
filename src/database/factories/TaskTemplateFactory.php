<?php

use Faker\Generator as Faker;
use Stylers\Laratask\Models\TaskTemplate;
use Stylers\Taxonomy\Models\Language;

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

$factory->define(TaskTemplate::class, function (Faker $faker) {
    $lang = Language::getDefaultLanguageCode();

    return [
        'name' => [
            'id' => null,
            'translations' => [
                $lang => $faker->word . uniqid(),
            ],
        ],
        'description' => [
            $lang => $faker->sentence
        ]
    ];
});
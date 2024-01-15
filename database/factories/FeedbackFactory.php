<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Feedback;
use Faker\Generator as Faker;

$factory->define(Feedback::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'feedback' => $faker->text,
        'stars' => $faker->numberBetween(1, 5),
        'course_id' => 1
    ];
});

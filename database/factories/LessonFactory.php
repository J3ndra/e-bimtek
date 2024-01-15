<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
    	'title'       => $faker->name,
		'description' => $faker->text,
    	'date'  => $faker->date,
        'course_id' => factory(App\Models\Course::class),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubLesson;
use Faker\Generator as Faker;

$factory->define(SubLesson::class, function (Faker $faker) {
    return [
        'lesson_id' => factory(App\Models\Lesson::class),
        'title'       => $faker->name,
		'description' => $faker->text,
		'duration' => '5 Jam',
		'video' => 'https://www.youtube.com/embed/QH2-TGUlwu4',
    ];
});

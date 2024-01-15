<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
		'thumbnail'   => 'public/uploads/images/admin/1/5f9e4c949da27.png',
		'slug'        => $faker->slug,
		'title'       => $faker->name,
		'description' => $faker->text,
		'start_date'  => $faker->iso8601,
		'end_date'    => $faker->iso8601,
		'price'       => $faker->randomNumber,
		'category_id' => factory(App\Models\Category::class),
		'team_id'     => 1,
    ];
});

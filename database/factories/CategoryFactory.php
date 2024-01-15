<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Facades\Service\CategoryService;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'icon' => 'public/uploads/images/admin/1/5f9e4c949da27.png',
        'name' => $faker->lastName,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    return [
        'name'          => $faker->unique()->word,
        'description'   => $faker->sentences(rand(3,5), true)
    ];
});

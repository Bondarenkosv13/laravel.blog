<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku'               => $faker->unique()->randomNumber(5),
        'name'              => $faker->unique()->sentence(rand(1,5)),
        'description'       => $faker->sentences(rand(5, 10), true),
        'short_description' => $faker->text(200),
        'thumbnail'         => $faker->file(
            Storage::disk('local')->path('public/seed_images'),
            Storage::disk('local')->path('public/images')),
        'price'             => $faker->randomFloat(2,100, 5000),
        'discount'          => rand(0, 35),
        'quantity'          => rand(0, 15)
    ];
});

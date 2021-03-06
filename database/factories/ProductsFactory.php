<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id'       => \App\Models\Category::get()->random()->id,
        'sku'               => $faker->unique()->randomNumber(5),
        'name'              => $faker->unique()->sentence(rand(1,5)),
        'description'       => $faker->sentences(rand(5, 10), true),
        'short_description' => $faker->text(200),
        'thumbnail'         => 'public/images/' . $faker->file(
            Storage::disk('public')->path('seed_images'),
            Storage::disk('public')->path('images'), false),
        'price'             => $faker->randomFloat(2,100, 5000),
        'discount'          => rand(0, 35),
        'quantity'          => rand(0, 15)
    ];
});

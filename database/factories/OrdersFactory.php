<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    $status = \App\Models\OrdersStatus::where('type', '=', array_rand(config('ordersStatus'), 1))->first();
    $user = \App\Models\User::where('id', '=', rand(1,10))->first();

    return [
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_surname' => $user->surname,
        'user_email' => $user->email,
        'user_phone' => $user->phone,
        'country' => $faker->country,
        'city' => $faker->city,
        'address' => $faker->address,
        'total' => $faker->randomFloat(2, 100, 20000),
        'status_id' => $status->id
    ];
});

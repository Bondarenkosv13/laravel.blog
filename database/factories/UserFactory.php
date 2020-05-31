<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {

    $role = \App\Models\Role::where('name', '=', config('roles.customer'))->first();

    return [
        'role_id' => $role->id,
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'birth_date' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber  ,
        'email_verified_at' => now(),
        'password' => Hash::make($faker->password), // password
        'remember_token' => Str::random(10)
    ];
});

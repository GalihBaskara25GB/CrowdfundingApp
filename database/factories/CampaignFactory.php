<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Campaign;
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

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'id' => Str::uuid()->toString(),
        'title' => $faker->sentence(6),
        'description' => $faker->sentence(300),
        'address' => $faker->address,
        'required' => $faker->numberBetween(1000000, 150000000),
    ];
});

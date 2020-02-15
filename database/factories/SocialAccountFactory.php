<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SocialAccount;
use App\User;
use Faker\Generator as Faker;

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

$factory->define(SocialAccount::class, function (Faker $faker) {
    return [
        'user_id' => create(User::class),
        'provider_id' => $faker->numberBetween(1000000, 299999999),
        'provider_name' => $faker->randomElement(['facebook', 'twitter', 'goggle', 'github'])
    ];
});

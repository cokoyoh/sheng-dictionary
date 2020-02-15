<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Definition;
use App\User;
use App\Word;
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

$factory->define(Word::class, function (Faker $faker) {
    return [
        'user_id' => create(User::class),
        'title' => $faker->sentence(6, false),
        'slug' => $faker->slug(6, false)
    ];
});


$factory->define(Definition::class, function (Faker $faker) {
    return [
        'word_id' => create(Word::class),
        'description' => $faker->sentence(5, false),
        'examples' => $faker->paragraph(3, false)
    ];
});

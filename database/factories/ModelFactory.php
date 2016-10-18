<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


// create a generator for posts
$factory->define(App\Post::class, function (Faker\Generator $faker) {
		
	return [
		'title' => $faker->opera,
		'description' => $faker->city
	];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
	return [
		'text' => $faker->streetAddress,
	];
});
	

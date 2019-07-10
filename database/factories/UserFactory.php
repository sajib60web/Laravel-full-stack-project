<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'phone_number' => $faker->unique()->phoneNumber,
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'),
        'remember_token' => Str::random(10),
        'photo' => $faker->imageUrl($width = 400, $height = 310),
        'email_verified' => 1,
        'email_verified_token' => '',
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->userName,
        'status' =>  rand(1,2),
    ];
});

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'user_id' =>  rand(1,10),
        'category_id' => rand(1,50),
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'thumbnail_path' => $faker->imageUrl($width = 770, $height = 310),
        'status' =>  rand(1,2),
    ];
});

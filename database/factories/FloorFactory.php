<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Floor;
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
// 'name', 'slug', 'status', 'display_order', 'created_by'

$factory->define(Floor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status'=>$faker->address,
        'display_order'=>$faker->e164PhoneNumber,
        'created_by'=>1
    ];
});

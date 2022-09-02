<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Film;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Film::class, function (Faker $faker) {
    $name =  $faker->sentence(5);
    $filmArray = [
       'download.jpg',
       'download1.jpg',
       'download2.jpg',
       'download3.jpg',
    ];
    return [
        'name' => $name,
        'slug'   => Str::slug($name),
        'description' => $faker->realText(rand(80, 600)),
        'release_date'  => $faker->date(),
        'rating' => rand(1,5),
        'ticket' =>  $faker->randomFloat(4, 3, 100),
        'photo'  => Arr::random($filmArray),
    ];
});

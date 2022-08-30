<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Film;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(Film::class, function (Faker $faker) {
    $name =  $faker->sentence(5);
    $filmArray = [
        public_path('img/download.jpg'),
        public_path('img/download1.jpg'),
        public_path('img/download2.jpg'),
        public_path('img/download3.jpg'),
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

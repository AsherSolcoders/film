<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'comment' => '<p class="mb-4">' . $this->faker->sentences(rand(5, 10), true) . '</p>',
    ];
});

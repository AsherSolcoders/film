<?php

use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\Comment',5)->create([
            'user_id' => User::all()->random()->id,
            'film_id' => Film::all()->random()->id
        ]);
    }
}

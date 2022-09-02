<?php

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = factory('App\Models\Genre',5)->create();

        factory('App\Models\Film',3)->create([
            'user_id' => User::all()->random()->id,
            'country'=> Country::all()->random()->name
        ])->each(function($film) use($genres) {
            $film->genres()->attach($genres->random(2));
        });
    }
}

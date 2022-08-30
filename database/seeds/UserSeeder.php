<?php

use App\Models\Country;
use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$genres = Genre::factory(10)->create();
        $genres = factory('App\Models\Genre',10)->create();
        
        factory('App\Models\User',1)->create()->each(function($user) use($genres) {
            factory('App\Models\Film',3)->create([
                'user_id' => $user->id,
                'country'=> Country::all()->random()->name
            ])->each(function($film) use($genres) {
                $film->genres()->attach($genres->random(2));
            });
            factory('App\Models\Comment',5)->create([
                'user_id' => $user->id,
                'film_id' => Film::all()->random()->id
            ]);
        });
    }
}

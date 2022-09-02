<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_films()
    {
        $user =   factory('App\Models\User')->create();
        $country =   Country::create(['name'=>'United States', 'code'=>'usa']);
        $film =   factory('App\Models\Film')->create([
            'user_id' => $user->id,
            'country'=> $country->name
        ]);
        $response = $this->get(route('films.index'));

        $response->assertStatus(200);
    }

    public function test_get_one_film()
    {
        $user =   factory('App\Models\User')->create();
        $country =   Country::create(['name'=>'United States', 'code'=>'usa']);
        $film =   factory('App\Models\Film')->create([
            'user_id' => $user->id,
            'country'=> $country->name
        ]);
        $response = $this->get(route('films.show',1));

        $response->assertStatus(200);
    }

    public function test_post_film()
    {
        $user =   factory('App\Models\User')->create();
        $this->post('login',[
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $genre =   factory('App\Models\Genre',3)->create();

        // $response = $this->get(route('films.index'));
        // $response->assertStatus(200);
        
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $country =   Country::create(['name'=>'United States', 'code'=>'usa']);
        $film =   [
            'user_id' => $user->id,
            'country'=> $country->name,
            'name' => 'Test Film',
            'slug'   => 'test-name',
            'description' => 'Test Description',
            'release_date'  => '2022-09-02',
            'genres' => Genre::get()->pluck('id'),
            'rating' => rand(1,5),
            'ticket' =>  99.99,
            'photo'  => $file,
        ];
        $this->json('POST',route('films.store'),$film);
        $this->assertEquals(1,Film::count());

    }
}

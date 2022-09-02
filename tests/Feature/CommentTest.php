<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_comments()
    {
        $user =   factory('App\Models\User')->create();
        $this->post('login',[
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        
        $country =   Country::create(['name'=>'United States', 'code'=>'usa']);
        $film =   factory('App\Models\Film')->create([
            'user_id' => $user->id,
            'country'=> $country->name
        ]);
        factory('App\Models\Comment')->create([
            'user_id' => $user->id,
            'film_id' => $film->id
        ]);

        $response=$this->json('GET','get-comments');
        $response->assertStatus(200);

    }

    public function test_post_comments()
    {
        $user =   factory('App\Models\User')->create();
        $country =   Country::create(['name'=>'United States', 'code'=>'usa']);
        $film =   factory('App\Models\Film')->create([
            'user_id' => $user->id,
            'country'=> $country->name
        ]);
        
        $comment = [
            'name' => 'Test Comment',
            'comment' => 'Test Comment Description',
        ];
       $this->json('POST','add-comment',$comment);
        $this->assertEquals(1,Comment::count());

    }
}

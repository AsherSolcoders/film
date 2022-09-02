<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_login_load()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_authenticate_user_login()
    {
        $user =   factory('App\Models\User')->create();

        $this->post('login',[
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
    }
}

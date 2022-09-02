<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_login_load()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function test_authenticate_admin_login()
    {
       $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post('admin/login',[
            'email' => $admin->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticatedAs($admin,'admin');
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Str;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_redirect_unauthintecated_guest_user_to_login_page()
    {
        $response = $this->get('/posts');
        $response->assertRedirect('/login');
    }

    public function test_login_and_get_access_of_posts_and_comments()
    {
        $user = User::factory()->create([
            'email' =>'mm@gmail.com'
        ]);
        
        $response = $this->post('/login', [
            'email' => 'mm@gmail.com',
            'password' => 'password'
        ]);

        $response->assertRedirect('/posts');
    }

    public function test_get_register_page(){
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register_user_and_access_posts_page()
    {
        $response = $this->post('/register', [
            'name' => 'test register',
            'email' => 'mm@register.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/posts');
    }


}

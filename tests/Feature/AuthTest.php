<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

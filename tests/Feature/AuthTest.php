<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test(): void
    {
        // Test Login with empty request
        $response = $this->post('/auth/login');
        $response->assertStatus(422);

        // Test Register with empty request
        $response = $this->post('/auth/register');
        $response->assertStatus(422);

        // Test Register
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('token', $content);

        // Test Login
        $response = $this->post('/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('token', $content);
    }
}

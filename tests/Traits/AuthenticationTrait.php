<?php

namespace Tests\Traits;

trait AuthenticationTrait
{
    private $authToken;

    protected function getAuthToken(): string
    {
        if (!$this->authToken) {
            $response = $this->post('/auth/register', [
                'name' => 'Test User',
                'email' => 'test@gmail.com',
                'password' => 'password',
            ]);
            $response->assertStatus(200);
            $content = json_decode($response->getContent(), true);
            $this->authToken = 'Bearer '.$content['token'];
        }

        return $this->authToken;
    }
}

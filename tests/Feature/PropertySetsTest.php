<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthenticationTrait;

class PropertySetsTest extends TestCase
{
    use RefreshDatabase,
        AuthenticationTrait;

    public function test(): void
    {
        // Test PropertySets index
        $response = $this->get('/property-sets');
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        // Test PropertySet creation without authentication
        $response = $this->post('/property-sets');
        $response->assertStatus(401);

        // Test PropertySet creation with authentication
        $response = $this->post('/property-sets', ['name' => 'Color'], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(201);
        $propertySet = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('id', $propertySet);

        // Test PropertySet show
        $response = $this->get("/property-sets/{$propertySet['id']}");
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('name', $content);
        $this->assertEquals('Color', $content['name']);

        // Test PropertySet show for non-existing id
        $response = $this->get('/property-sets/0');
        $response->assertStatus(404);

        // Test PropertySet update without authentication
        $response = $this->patch("/property-sets/{$propertySet['id']}");
        $response->assertStatus(401);

        // Test PropertySet update with authentication
        $response = $this->patch("/property-sets/{$propertySet['id']}", ['name' => 'Size'], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('name', $content);
        $this->assertEquals('Size', $content['name']);

        // Test PropertySet update with authentication, but for non-existing id
        $response = $this->patch("/property-sets/0", [], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(404);

        // Test PropertySet delete without authentication
        $response = $this->delete("/property-sets/{$propertySet['id']}");
        $response->assertStatus(401);

        // Test PropertySet delete with authentication
        $response = $this->delete("/property-sets/{$propertySet['id']}", [], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(204);

        // Test PropertySet delete with authentication, but for non-existing id
        $response = $this->delete("/property-sets/0", [], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(404);
    }
}

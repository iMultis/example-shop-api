<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AuthenticationTrait;

class PropertiesTest extends TestCase
{
    use RefreshDatabase,
        AuthenticationTrait;

    public function test(): void
    {
        // Create PropertySet
        $response = $this->post('/property-sets', ['name' => 'Color'], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(201);
        $propertySet = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('id', $propertySet);

        // Test Properties index
        $response = $this->get("/property-sets/{$propertySet['id']}/properties");
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        // Test Property creation without authentication
        $response = $this->post("/property-sets/{$propertySet['id']}/properties");
        $response->assertStatus(401);

        // Test Property creation with authentication
        $response = $this->post("/property-sets/{$propertySet['id']}/properties", ['name' => 'Green'], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(201);
        $property = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('id', $property);

        // Test Property show
        $response = $this->get("/property-sets/{$propertySet['id']}/properties/{$property['id']}");
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('name', $content);
        $this->assertEquals('Green', $content['name']);

        // Test Property show for non-existing id
        $response = $this->get("/property-sets/{$propertySet['id']}/properties/0");
        $response->assertStatus(404);

        // Test Property update without authentication
        $response = $this->patch("/property-sets/{$propertySet['id']}/properties/{$property['id']}");
        $response->assertStatus(401);

        // Test Property update with authentication
        $response = $this->patch("/property-sets/{$propertySet['id']}/properties/{$property['id']}", ['name' => 'Blue'], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('name', $content);
        $this->assertEquals('Blue', $content['name']);

        // Test Property update with authentication, but for non-existing id
        $response = $this->patch("/property-sets/{$propertySet['id']}/properties/0", [], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(404);

        // Test Property delete without authentication
        $response = $this->delete("/property-sets/{$propertySet['id']}/properties/{$property['id']}");
        $response->assertStatus(401);

        // Test PropertySet delete with authentication
        $response = $this->delete("/property-sets/{$propertySet['id']}/properties/{$property['id']}", [], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(204);

        // Test PropertySet delete with authentication, but for non-existing id
        $response = $this->delete("/property-sets/0", [], ['Authorization' => $this->getAuthToken()]);
        $response->assertStatus(404);
    }
}

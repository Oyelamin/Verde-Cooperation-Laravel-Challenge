<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IntegrationsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIntegrationCreation()
    {
        $response = $this->post('/api/integration/create', [
            'marketplace' => 'AMAZON',
            'username' => generateRandomString(),
            'password' => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'message', 'data']);;
    }


}

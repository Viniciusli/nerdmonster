<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_can_be_created(): void
    {
        // prepare
        $payload = [
            'name' => 'vinicius Teste',
            'number' => '123456',
        ];

        // act
        $response = $this->post('/api/create-ticket', $payload);

        // assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'number' => $payload['number'],
        ]);
    }
}

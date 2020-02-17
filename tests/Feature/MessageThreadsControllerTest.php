<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PassportAuth;

class MessageThreadsControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth;

    /** @test */
    public function fetch_most_recent_message_threads()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/message-threads');

        $response->assertStatus(200);
    }
}

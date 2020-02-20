<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PassportAuth;
use Tests\TestTraits\MessageThreadTrait;

class MessageThreadsControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth, MessageThreadTrait;

    /** @test */
    public function fetch_most_recent_message_threads()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/message-threads');

        $response->assertOk();
    }

    /** @test */
    public function fetch_most_recent_message_threads_and_has_empty_data()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/message-threads');

        $response->assertStatus(204);
    }

    /** @test */
    public function fetch_most_recent_message_threads_while_not_authenticated()
    {
        $response = $this->getJson('/api/message-threads');
        $response->assertUnauthorized();
    }
}

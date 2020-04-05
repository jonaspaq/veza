<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PassportAuth;
use Tests\TestTraits\MessageThreadTestTrait;

class MessageThreadsControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth, MessageThreadTestTrait;

    /** @test */
    public function fetch_most_recent_message_threads()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $this->createMessageThread($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/message-threads');

        $response->assertOk()
                ->assertJsonStructure([
                    'current_page',
                    'data' => [
                        [
                            'id',
                            'user_one',
                            'user_two',
                            'last_activity',
                            'created_at',
                            'updated_at',
                            'sender' => [
                                'id',
                                'name'
                            ],
                            'receiver' => [
                                'id',
                                'name'
                            ]
                        ]
                    ],
                    'first_page_url',
                    'from',
                    'last_page',
                    'last_page_url',
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to',
                    'total'
                ]);
    }

    /** @test */
    public function fetch_most_recent_message_threads_while_not_authenticated()
    {
        $response = $this->getJson('/api/message-threads');
        $response->assertUnauthorized();
    }
}

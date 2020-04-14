<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PassportAuth;
use Tests\TestTraits\MessageThreadTestTrait;
use Tests\TestTraits\MessageTestTrait;

class MessageThreadsControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth, MessageThreadTestTrait, MessageTestTrait;

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

    /** @test */
    public function fetch_a_specific_message_thread()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/message-threads/'.$thread->id);

        $response->assertOk()
                ->assertJsonStructure([
                    'id',
                    'user_one',
                    'user_two',
                    'sender',
                    'receiver',
                    'last_activity',
                    'created_at',
                    'updated_at'
                ]);
    }

    /** @test */
    public function fetch_a_specific_message_thread_while_not_authenticated()
    {
        $response = $this->getJson('/api/message-threads/1');

        $response->assertUnauthorized();
    }

    /** @test */
    public function fetch_a_specific_message_thread_that_does_not_exist()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/message-threads/-1');

        $response->assertNotFound()
                ->assertSee('Message Thread/Conversation not found');
    }

    /** @test */
    public function delete_a_specific_message_thread()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);
        $sendMessage = $this->sendMessageMany($thread, $user);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/message-threads/'.$thread->id);

        $response->assertOk()->assertSee('Successfully deleted');

        // Check database if it is really deleted
        $this->assertDatabaseMissing('message_threads',[
                'id' => $thread->id
            ]);
    }

    /** @test */
    public function delete_a_specific_message_thread_while_not_authenticated()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);

        $response = $this->deleteJson('/api/message-threads/'.$thread->id);

        $response->assertUnauthorized();
    }

    /** @test */
    public function delete_a_specific_message_thread_that_does_not_exist()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/message-threads/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function delete_a_specific_message_thread_that_is_not_owned_by_the_user()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $user3 = $this->createRandomUser();
        $thread = $this->createMessageThread($user2, $user3);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/message-threads/'.$thread->id);

        $response->assertNotFound();
    }
}

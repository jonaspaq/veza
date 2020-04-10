<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\PassportAuth;
use Tests\TestTraits\MessageThreadTestTrait;
use Tests\TestTraits\MessageTestTrait;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth, MessageThreadTestTrait, MessageTestTrait;

    /** @test */
    public function fetch_all_messages_from_a_specified_message_thread()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);
        $messages = $this->sendMessageMany($thread, $user);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/thread/messages/'.$thread->id);

        $response->assertOk()
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    [
                        'id',
                        'user_id',
                        'body',
                        'sender',
                        'created_at',
                        'updated_at',
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
    public function fetch_all_messages_from_a_specified_message_thread_while_not_authenticated()
    {
        $response = $this->getJson('/api/thread/messages/1');

        $response->assertUnauthorized();
    }

    /** @test */
    public function fetch_all_messages_from_a_specified_message_thread_that_is_not_related_to_the_user()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $user3 = $this->createRandomUser();
        $thread = $this->createMessageThread($user2, $user3);
        $messages = $this->sendMessageMany($thread, $user2);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/thread/messages/'.$thread->id);

        $response->assertNotFound();
    }

    /** @test */
    public function fetch_all_messages_from_a_non_existent_thread()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/thread/messages/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function send_a_new_message_to_a_thread()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/thread/message', [
                            'thread_id' => $thread->id,
                            'body' => 'This is my message'
                        ]);

        $response->assertOk()
                ->assertJsonStructure([
                    'id',
                    'user_id',
                    'body',
                    'created_at',
                    'updated_at'
                ]);
    }

    /** @test */
    public function send_a_new_message_to_a_thread_with_empty_inputs()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/thread/message', [
                            'thread_id' => null,
                            'body' => null
                        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function send_a_new_message_to_a_thread_that_is_not_related_to_user()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $user3 = $this->createRandomUser();
        $thread = $this->createMessageThread($user3, $user2);

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/thread/message', [
                            'thread_id' => $thread->id,
                            'body' => 'This is my message'
                        ]);

        $response->assertNotFound();
    }

    /** @test */
    public function delete_a_message_from_a_thread()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $thread = $this->createMessageThread($user, $user2);
        $message = $this->sendMessage($thread, $user);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/thread/message/'.$message->id);

        $response->assertOk();
    }

    /** @test */
    public function delete_a_message_from_a_thread_that_is_not_related_to_user()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $user3 = $this->createRandomUser();
        $thread = $this->createMessageThread($user3, $user2);
        $message = $this->sendMessage($thread, $user2);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/thread/message/'.$message->id);

        $response->assertNotFound();
    }
}

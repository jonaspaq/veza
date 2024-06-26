<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\PassportAuth;
use Tests\TestTraits\FriendListTestTrait;

class FriendListControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth, FriendListTestTrait;

    /** @test */
    public function retrieve_all_friends()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $this->createFriend($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friend');

        $response->assertOk()
                ->assertJsonStructure([
                    'current_page',
                    'data' => [
                        [
                            'id',
                            'user_one',
                            'user_two',
                            'status',
                            'created_at',
                            'updated_at',
                            'sender' => [
                                'id',
                                'first_name',
                                'last_name',
                                'email'
                            ],
                            'receiver' => [
                                'id',
                                'first_name',
                                'last_name',
                                'email'
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
    public function retrieve_all_friends_while_not_authenticated()
    {
        $response = $this->getJson('/api/friend');

        $response->assertUnauthorized();
    }

    /** @test */
    public function retrieve_all_friend_requests_who_has_atleast_one_request()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $this->createFriendRequest($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friends/received-requests');

        $response->assertOk();
    }

    /** @test */
    public function retrieve_all_friend_requests_who_has_zero_request()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friends/received-requests');

        $response->assertStatus(204);
    }

    /** @test */
    public function retrieve_all_friend_requests_while_not_authenticated()
    {
        $response = $this->getJson('/api/friends/received-requests');

        $response->assertUnauthorized();
    }

    /** @test */
    public function retrieve_all_sent_friend_requests_who_has_atleast_one_request()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $this->createFriendSent($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friends/sent-requests');

        $response->assertOk();
    }

    /** @test */
    public function retrieve_all_sent_friend_requests_who_has_zero_request()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friends/sent-requests');

        $response->assertStatus(204);
    }

    /** @test */
    public function retrieve_all_sent_friend_requests_while_not_authenticated()
    {
        $response = $this->getJson('/api/friends/sent-requests');

        $response->assertUnauthorized();
    }

    /** @test */
    public function retieve_friend_request_count()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friends/request-count');

        $response->assertOk();
    }

    /** @test */
    public function retieve_friend_request_count_while_not_authenticated()
    {
        $response = $this->getJson('/api/friends/request-count');

        $response->assertUnauthorized();
    }

    /** @test */
    public function retieve_friend_suggestions()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/friends/suggestions');

        $response->assertOk();
    }

    /** @test */
    public function retieve_friend_suggestions_while_not_authenticated()
    {
        $response = $this->getJson('/api/friends/suggestions');

        $response->assertUnauthorized();
    }

    /** @test */
    public function add_a_friend()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/friend',[
                            'id' => $user2->id
                        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function add_a_friend_while_not_authenticated()
    {
        $user2 = $this->createRandomUser();

        $response = $this->postJson('/api/friend',[
                            'id' => $user2->id
                        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function add_a_friend_who_is_not_existing_user()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/friend',[
                            'id' => '-1'
                        ]);

        $response->assertNotFound();
    }

    /** @test */
    public function add_a_friend_while_id_data_is_empty()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/friend',[
                            'id' => null
                        ]);

        $response->assertForbidden();
    }

    /** @test */
    public function accept_a_friend_request()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $friendRequest = $this->createFriendRequest($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->putJson('/api/friend/'.$friendRequest->id);

        $response->assertOk();
    }

    /** @test */
    public function accept_a_friend_request_passing_a_non_existing_id()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->putJson('/api/friend/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function accept_a_friend_request_while_not_authenticated()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $friendRequest = $this->createFriendRequest($user, $user2);

        $response = $this->putJson('/api/friend/'.$friendRequest->id);

        $response->assertUnauthorized();
    }

    /** @test */
    public function decline_a_friend_request()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $friendRequest = $this->createFriendRequest($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/friend/'.$friendRequest->id);

        $response->assertStatus(204);
    }

    /** @test */
    public function decline_a_friend_request_passing_a_non_existing_id()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/friend/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function decline_a_friend_request_while_not_authenticated()
    {
        $response = $this->deleteJson('/api/friend/1');

        $response->assertUnauthorized();
    }

    /** @test */
    public function remove_a_friend()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $friend = $this->createFriend($user, $user2);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/friend/'.$friend->id);

        $response->assertStatus(204);
    }

    /** @test */
    public function remove_a_non_existing_friend()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/friend/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function remove_a_friend_while_not_authenticated()
    {
        $user = $this->passportAndCreateUser();
        $user2 = $this->createRandomUser();
        $friend = $this->createFriend($user, $user2);

        $response = $this->deleteJson('/api/friend/'.$friend->id);

        $response->assertUnauthorized();
    }
}

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

        $response->assertOk();
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
}

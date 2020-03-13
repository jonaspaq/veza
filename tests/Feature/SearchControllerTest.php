<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\PassportAuth;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth;

    private $userSearchData = [
        'data' => 'testUser'
    ];

    /** @test */
    public function search_for_a_user()
    {
        $user = $this->passportAndCreateUser();
        $searchData = $this->userSearchData;

        $response = $this->actingAs($user, 'api')
                        ->postJson('/search/user', $searchData);

        $response->assertOk();
    }

    /** @test */
    public function search_for_a_user_with_empty_data_on_submit()
    {
        $user = $this->passportAndCreateUser();
        $searchData = $this->userSearchData;

        $response = $this->actingAs($user, 'api')
                        ->postJson('/search/user', $this->userSearchData);

        $response->assertStatus(422);
    }

    /** @test*/
    public function search_for_a_user_while_not_authenticated()
    {
        $searchData = $this->userSearchData;
        $response = $this->postJson('/search/user', $searchData);

        $response->assertUnauthorized();
    }
}

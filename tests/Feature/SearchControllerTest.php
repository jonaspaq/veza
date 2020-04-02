<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\PassportAuth;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth;

    private $userSearchData = '?q=test@example.com';

    /** @test */
    public function search_for_a_user()
    {
        $user = $this->passportAndCreateUser();
        $searchData = $this->userSearchData;

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/search/user'.$searchData);

        $response->assertOk()
                ->assertJsonStructure([
                    'current_page',
                    'data' => [
                        [
                            'id',
                            'name',
                            'created_at'
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
    public function search_for_a_user_with_empty_data_on_submit()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/search/user');

        $response->assertStatus(422);
    }

    /** @test*/
    public function search_for_a_user_while_not_authenticated()
    {
        $searchData = $this->userSearchData;

        $response = $this->getJson('/api/search/user'.$searchData);

        $response->assertUnauthorized();
    }
}

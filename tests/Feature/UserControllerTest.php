<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

use Tests\PassportAuth;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth;

    /** @test */
    public function register_user_with_correct_details()
    {
        $response = $this->postJson('/api/register', [
                            'name' => 'Test User',
                            'email' => 'testuser@veza.com',
                            'password' => 'password',
                            'password_confirmation' => 'password'
                        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function register_user_with_empty_data()
    {
        $response = $this->postJson('/api/register', [
                            'name' => '',
                            'email' => '',
                            'password' => '',
                            'password_confirmation' => ''
                        ]);
        $response->assertStatus(422);
    }

    /** @test */
    public function login_user_with_correct_details()
    {
        $this->passportAndCreateUser();

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com.unknown',
            'password' => 'password'
        ]);

        $response->assertOk();
    }

    /** @test */
    public function login_user_with_non_existing_credentials()
    {
        $this->passportInstallCommando();

        $response = $this->postJson('/api/login', [
            'email' => 'non_existing_email@unknown.unknown.com',
            'password' => 'non_existing_password_at_all'
        ]);

        $response->assertStatus(404);
    }

    /** @test */
    public function login_user_with_empty_credentials()
    {
        $this->passportInstallCommando();

        $response = $this->postJson('/api/login', [
            'email' => '',
            'password' => ''
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function get_details_of_the_authenticated_user()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/user/authDetails');

        $response->assertOk();
    }

    /** @test */
    public function get_details_of_an_existing_specified_user()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/user/'.$user->id);

        $response->assertOk();
    }

    /** @test */
    public function get_details_of_a_non_existent_specified_user()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/user/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function get_details_of_a_specified_user_while_not_authenticated()
    {
        $response = $this->getJson('/api/user/1');

        $response->assertUnauthorized();
    }
}

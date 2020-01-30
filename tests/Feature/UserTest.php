<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use Tests\PassportInstall;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_user_with_correct_details()
    {
        $response = $this->withHeaders([
                        'Accept' => 'application/json'
                        ])
                        ->postJson('/api/register', [
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
        $response = $this->withHeaders([
                        'Accept' => 'application/json'
                        ])
                        ->postJson('/api/register', [
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
        $data = PassportInstall::installPassportClient();

        factory(User::class)->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function login_user_with_wrong_details()
    {
        $data = PassportInstall::installPassportClient();

        $response = $this->postJson('/api/login', [
            'email' => 'non_existing_email@unknow.com',
            'password' => 'non_existing_password'
        ]);

        $response->assertStatus(404);
    }
}

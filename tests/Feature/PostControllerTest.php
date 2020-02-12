<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\PassportAuth;
use Tests\TestTraits\PostTestTrait;
use App\Post;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, PassportAuth, PostTestTrait;

    /** @test */
    public function retrieve_all_posts_of_the_authenticated_user_who_has_not_posted_anything()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/post');

        $response->assertStatus(204);
    }

    /** @test */
    public function retrieve_all_post_of_the_authenticated_user_who_has_atleast_one_post()
    {
        $user = $this->passportAndCreateUser();

        factory(Post::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/post');

        $response->assertOk();
    }

    /** @test */
    public function retrieve_an_existing_specific_post()
    {
        $user = $this->passportAndCreateUser();
        $post = $this->createPost($user);

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/post/'.$post->id);

        $response->assertOk();
    }

    /** @test */
    public function retrieve_a_non_existing_specific_post()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->getJson('/api/post/-1');

        $response->assertNotFound();
    }

    /** @test */
    public function retrieve_all_post_not_being_authenticated()
    {
        $response = $this->getJson('/api/post');

        $response->assertStatus(401);
    }

    /** @test */
    public function create_a_post_while_being_authenticated()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/post', [
                            'content' => 'This is a new post.'
                        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function create_a_post_with_empty_data()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->postJson('/api/post', [
                            'content' => ''
                        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function create_a_post_while_not_being_authenticated()
    {
        $response = $this->postJson('/api/post', [
            'content' => 'A post of an unauthenticated user.'
        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function update_a_post_while_authenticated()
    {
        $user = $this->passportAndCreateUser();

        $post = $this->createPost($user);

        $response = $this->actingAs($user, 'api')
                        ->patchJson('/api/post/'.$post->id, [
                            'content' => 'This is the new updated post.'
                        ]);

        $response->assertOk();
    }

    /** @test*/
    public function update_a_post_with_empty_data()
    {
        $user = $this->passportAndCreateUser();

        $post = $this->createPost($user);

        $response = $this->actingAs($user, 'api')
                        ->patchJson('/api/post/'.$post->id, [
                            'content' => ''
                        ]);

        $response->assertStatus(422);
    }

    /** @test*/
    public function update_a_non_existing_post()
    {
        $user = $this->passportAndCreateUser();

        $response = $this->actingAs($user, 'api')
                        ->patchJson('/api/post/-1', [
                            'content' => 'A non-existing post.'
                        ]);

        $response->assertStatus(404);
    }

    /** @test */
    public function update_a_post_while_not_being_authenticated()
    {
        $user = $this->passportAndCreateUser();

        $post = $this->createPost($user);

        $response = $this->patchJson('/api/post/'.$post->id, [
                            'content' => 'This is the new updated post.'
                        ]);

        $response->assertUnauthorized();
    }

    /** @test */
    public function delete_a_post_while_authenticated()
    {
        $user = $this->passportAndCreateUser();

        $post = $this->createPost($user);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/post/'.$post->id);

        $response->assertOk();
    }

    /** @test */
    public function delete_a_post_while_not_being_authenticated()
    {
        $response = $this->deleteJson('/api/post/-1');

        $response->assertUnauthorized();
    }

    /** @test */
    public function delete_a_post_not_owned_by_the_user()
    {
        $user = $this->passportAndCreateUser();
        $post = $this->createPost($user);
        $randomUser = $this->createRandomUser();

        $response = $this->actingAs($randomUser, 'api')
                        ->deleteJson('/api/post/'.$post->id);

        $response->assertForbidden();
    }

    /** @test */
    public function delete_a_non_existing_post()
    {
        $user = $this->passportAndCreateUser();
        $post = $this->createPost($user);

        $response = $this->actingAs($user, 'api')
                        ->deleteJson('/api/post/-1');

        $response->assertNotFound();
    }
}

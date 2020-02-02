<?php

namespace Tests\TestTraits;

use App\Post;
use App\User;

trait PostTestTrait
{
    // Create one post
    public static function createPost(User $user)
    {
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        return $post;
    }
}
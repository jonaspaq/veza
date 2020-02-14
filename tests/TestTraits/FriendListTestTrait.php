<?php

namespace Tests\TestTraits;

use App\FriendList;
use App\User;

trait FriendListTestTrait
{
    // Create one friend
    public static function createFriend(User $user, User $user2)
    {
        $friend = factory(FriendList::class)->create([
            'user_one' => $user->id,
            'user_two' => $user2->id,
            'status' => 'friends'
        ]);

        return $friend;
    }

    // Create one friend request
    public static function createFriendRequest(User $user, User $user2)
    {
        $friend = factory(FriendList::class)->create([
            'user_two' => $user->id,
            'user_one' => $user2->id,
            'status' => 'pending'
        ]);

        return $friend;
    }

    // Create one friend sent request
    public static function createFriendSent(User $user, User $user2)
    {
        $friend = factory(FriendList::class)->create([
            'user_one' => $user->id,
            'user_two' => $user2->id,
            'status' => 'pending'
        ]);

        return $friend;
    }
}

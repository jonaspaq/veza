<?php

namespace Tests\TestTraits;

use App\MessageThread;
use App\User;

trait MessageThreadTestTrait
{
    public function createMessageThread(User $user, User $user2)
    {
        return factory(MessageThread::class)->create([
            'user_one' => $user->id,
            'user_two' => $user2->id
        ]);
    }
}

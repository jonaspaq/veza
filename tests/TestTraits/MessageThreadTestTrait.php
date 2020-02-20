<?php

namespace Tests\TestTraits;

use App\MessageThread;

trait MessageThreadTrait
{
    public function createMessageThread(User $user, User $user2)
    {
        return factory(MessageThread::class)->create([
            'user_one' => $user2->id,
            'user_two' => $user->id
        ]);
    }
}

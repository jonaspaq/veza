<?php

namespace Tests\TestTraits;

use App\Message;
use App\MessageThread;
use App\User;

trait MessageTestTrait
{
    public function sendMessage(MessageThread $thread, User $sender)
    {
        return Message::create([
            'user_id' => $sender->id,
            'body' => 'This is the message',
            'messageable_type' => 'App\MessageThread',
            'messageable_id' => $thread->id
        ]);
    }
}

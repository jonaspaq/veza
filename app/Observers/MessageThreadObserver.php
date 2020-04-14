<?php

namespace App\Observers;

use App\MessageThread;

class MessageThreadObserver
{
    /**
     * Handle the message thread "created" event.
     *
     * @param  \App\MessageThread  $messageThread
     * @return void
     */
    public function created(MessageThread $messageThread)
    {
        //
    }

    /**
     * Handle the message thread "updated" event.
     *
     * @param  \App\MessageThread  $messageThread
     * @return void
     */
    public function updated(MessageThread $messageThread)
    {
        //
    }

    /**
     * Handle the message thread "deleted" event.
     *
     * @param  \App\MessageThread  $messageThread
     * @return void
     */
    public function deleted(MessageThread $messageThread)
    {
        // Delete messages from this thread
        $messageThread->messages()->delete();
    }

    /**
     * Handle the message thread "restored" event.
     *
     * @param  \App\MessageThread  $messageThread
     * @return void
     */
    public function restored(MessageThread $messageThread)
    {
        //
    }

    /**
     * Handle the message thread "force deleted" event.
     *
     * @param  \App\MessageThread  $messageThread
     * @return void
     */
    public function forceDeleted(MessageThread $messageThread)
    {
        //
    }
}

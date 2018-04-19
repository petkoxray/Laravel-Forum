<?php

namespace App\Listeners;

use App\Events\ThreadHasNewReply;

class NotifyThreadSubscribers
{
    public function handle(ThreadHasNewReply $event)
    {
        $event->reply->thread->subscriptions
            ->where('user_id', '!=', $event->reply->user_id)
            ->each
            ->notify($event->reply);
    }
}

<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ThreadHasNewReply;
use App\Notifications\YouWereMentioned;

class NotifyMentionedUsers
{
    /**
     * Handle the event.
     *
     * @param  ThreadHasNewReply  $event
     * @return void
     */
    public function handle(ThreadHasNewReply $event)
    {
        User::whereIn('username', $event->reply->mentionedUsers())
            ->get()
            ->each
            ->notify(new YouWereMentioned($event->reply));
    }
}

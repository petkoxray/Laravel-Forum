<?php

namespace App\Events;

use App\Models\Reply;
use Illuminate\Queue\SerializesModels;

class ThreadHasNewReply
{
    use SerializesModels;

    public $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}

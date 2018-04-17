<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptions extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     */
    public function store($channelId, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * @param $channelId
     * @param Thread $thread
     */
    public function destroy($channelId, Thread $thread )
    {
        $thread->unsubscribe();
    }
}

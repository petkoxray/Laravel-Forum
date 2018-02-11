<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReply;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Add a reply to the thread
     *
     * @param StoreReply $request
     * @param Channel $channel
     * @param Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReply $request, Channel $channel, Thread $thread)
    {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }
}

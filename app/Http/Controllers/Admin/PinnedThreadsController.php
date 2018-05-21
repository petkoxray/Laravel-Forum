<?php

namespace App\Http\Controllers\Admin;

use App\Models\Thread;
use App\Http\Controllers\Controller;

class PinnedThreadsController extends Controller
{
    /**
     * Pin a Thread.
     *
     * @param Thread $thread
     */
    public function store(Thread $thread)
    {
        $thread->update(['pinned' => true]);
    }

    /**
     * Unpin a Thread.
     *
     * @param Thread $thread
     */
    public function destroy(Thread $thread)
    {
        $thread->update(['pinned' => false]);
    }
}

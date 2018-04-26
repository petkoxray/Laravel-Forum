<?php

namespace App\Http\Controllers\Admin;

use App\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LockedThreadsController extends Controller
{
    /**
     * Lock a Thread
     *
     * @param Thread $thread
     */
    public function store(Thread $thread)
    {
        $thread->update(['locked' => true]);
    }

    /**
     * Unlock a Thread
     *
     * @param Thread $thread
     */
    public function destroy(Thread $thread)
    {
        $thread->update(['locked' => false]);
    }
}

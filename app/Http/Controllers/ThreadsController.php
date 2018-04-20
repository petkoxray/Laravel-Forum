<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Http\Requests\StoreThread;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Models\Thread;
use Illuminate\Http\Response;

class ThreadsController extends Controller
{
    const REPLIES_PER_PAGE = 10;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the Threads.
     *
     * @param  Channel $channel
     * @param ThreadFilters $filters
     * @return Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return view('threads.index',
            ['threads' => $threads->paginate(5)]);
    }

    /**
     * Show the form for creating a new thread.
     *
     * @return Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created thread in storage.
     *
     * @param StoreThread $request
     * @return Response
     */
    public function store(StoreThread $request)
    {
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'channel_id' => request('channel_id'),
            'body' => request('body')
        ]);

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published!');
    }

    /**
     * Display the specified thread.
     *
     * @param Channel $channel
     * @param  Thread $thread
     * @return Response
     */
    public function show(Channel $channel, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified thread.
     *
     * @param  Thread $thread
     * @return Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified thread in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Thread $thread
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified thread from storage.
     *
     * @param Channel $channel
     * @param  \App\Models\Thread $thread
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Channel $channel, Thread $thread)
    {
        $this->authorize('delete', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect()->route('all_threads');
    }
}

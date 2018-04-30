<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Channel;
use App\Widgets\Trending;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Filters\ThreadFilters;
use App\Http\Requests\StoreThread;

class ThreadsController extends Controller
{
    /**
     * @var Trending
     */
    private $trending;

    public function __construct(Trending $trending)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->trending = $trending;
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

        return view('threads.index', [
            'threads' => $threads->paginate(config('forum.pagination.threads')),
            'trending' => $this->trending->get()
        ]);
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
        $this->trending->push($thread);
        $thread->increment('visits');

        return view('threads.show', compact('thread'));
    }

    /**
     * Update the specified thread in storage.
     *
     * @param Channel $channel
     * @param  \App\Models\Thread $thread
     * @return Thread
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update(request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree'
        ]));

        return $thread;
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

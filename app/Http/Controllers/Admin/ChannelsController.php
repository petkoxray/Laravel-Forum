<?php

namespace App\Http\Controllers\Admin;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::all();

        return view('admin.channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new channel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.channels.create', ['channel' => new Channel]);
    }

    /**
     * Store a new channel
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store()
    {
        $channel = Channel::create(
            request()->validate([
                'name' => 'required|unique:channels',
            ])
        );

        cache()->forget('channels');

        return redirect(route('admin_channels_all'))
            ->with('flash', 'Your channel has been created!');
    }
}


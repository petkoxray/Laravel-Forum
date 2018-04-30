<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    /**
     * Get user settings view.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        return view('users.settings.index');
    }

    /**
     * Store avatar.
     *
     * @param User $user
     */
    public function store_avatar(User $user)
    {
        request()->validate(['avatar' => 'required|image']);

        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return response([], 204);
    }
}

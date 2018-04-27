<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserSettingsController extends Controller
{
    public function index(User $user)
    {
        return view('users.settings.index');
    }

    public function store_avatar(User $user)
    {
        request()->validate([
            'avatar' => ['required', 'image']
        ]);


        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return response([], 204);
    }
}

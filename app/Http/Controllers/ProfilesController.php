<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;

class ProfilesController extends Controller
{
    /**
     * Show a user profile and activity feed.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{
    /**
     * Confirm user account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();

        if (! $user) {
            return redirect()->route('home')
                ->with('flash', 'Invalid token');
        }

        $user->confirm();

        return redirect()->route('home')
            ->with('flash', 'User account confirmed successfully!');
    }
}

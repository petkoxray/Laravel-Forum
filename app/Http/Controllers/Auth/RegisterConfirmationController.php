<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();

        if (!$user) {
            return redirect()->route('home')
                ->with('flash', 'Invalid token');
        }

        $user->confirm();

        return redirect()->route('home')
            ->with('flash', 'User account confirmed successfully!');
    }
}

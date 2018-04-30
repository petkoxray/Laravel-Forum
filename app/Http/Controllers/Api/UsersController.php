<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Search users by names.
     *
     * @return mixed
     */
    public function index()
    {
        $search = request('username');

        return User::where('username', 'like', "%$search%")
            ->pluck('username')
            ->take(5);
    }
}

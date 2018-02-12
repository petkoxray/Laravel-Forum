<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Favorite a reply
     *
     * @param Reply $reply
     */
    public function store(Reply $reply)
    {
        $reply->favorite();
    }
}

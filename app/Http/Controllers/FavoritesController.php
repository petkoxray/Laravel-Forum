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
     * Like a reply
     *
     * @param Reply $reply
     * @return Request
     */
    public function store(Reply $reply)
    {
        $reply->favorite();

        return back();
    }

    /**
     * Unlike a reply
     *
     * @param Reply $reply
     */
    public function destroy(Reply $reply)
    {
        $reply->unfavorite();
    }
}

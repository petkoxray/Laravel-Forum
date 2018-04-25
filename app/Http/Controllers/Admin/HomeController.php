<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the admin  application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response('How are you :)');
    }
}

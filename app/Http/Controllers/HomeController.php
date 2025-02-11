<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        $posts = Post::with('user')->latest()->get();
        return view('welcome', ['posts' => $posts]);
    }
}

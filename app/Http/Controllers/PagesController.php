<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PagesController extends Controller
{
    public function home()
    {
        $posts = Post::published()
            ->with(['category', 'tags', 'photos'])
            ->paginate(6);

        return view('welcome', compact('posts'));
    }

    public function portafolio()
    {
        $posts = Post::published()
            ->with(['category', 'tags', 'photos'])
            ->take(6)
            ->get();

        return view('portafolio', compact('posts'));
    }
}

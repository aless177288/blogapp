<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class PostsController extends Controller
{
    public function category(Category $category)
    {
        $posts = $category->posts()
            ->published()
            ->with(['category', 'tags', 'photos'])
            ->paginate(6);

        return view('posts.categoryPosts', compact('category', 'posts'));
    }

    public function show(Post $post)
    {
        $post->load(['category', 'tags', 'photos']);

        return view('posts.show', compact('post'));
    }
}

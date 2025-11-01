<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class PostsController extends Controller
{
    public function category(Category $category){


 $posts = $category->posts()->latest()->get();

  

    
    return view('posts.categoryPosts', compact('category','posts'));
    }



    public function show(Post $post)
    {   
        // $post = Post::find($id);

        $categories = Category::all();
    return view('posts.show',compact('categories','post'));


    }
}

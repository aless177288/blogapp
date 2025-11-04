<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PagesController extends Controller
{
            public function home()
            {
                
                // se movio a query scopes en Post.php

                // $posts = Post::whereNotNull('published_at')
                // ->where('published_at','<=',Carbon::now())
                // ->latest('published_at')->get();
$posts = Post::published()->paginate(6);
$categories = Category::all();
return view('welcome', compact('posts','categories'));

            }


            public function portafolio(){
$posts = Post::all();
                return view('portafolio',compact('posts'));
            }
            
          

}

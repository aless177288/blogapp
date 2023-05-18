<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
       return view('admin.posts.index',compact('posts')) ;
    }

    public function create(){
        $tags = Tag::all();
        $categorias = Category::all();
        return view('admin.posts.create',compact('categorias','tags'));
        // return view('admin.posts.create');
    }

        public function store(Request $request){
            $this->validate($request, ['title'=>'required']);
        $title =$request->get('title');
        $slug = Str::slug($title);
  
       
        $post= Post::Create([
        'title' => $title,
        'url'=> $slug ]);
                   
        return redirect()->route('admin.posts.edit', $post);

        }
        public function edit(Post $post){


            $tags = Tag::all();
            $categorias = Category::all();
            return view('admin.posts.edit',compact('categorias','tags','post'));
        }

        public function update(Post $post, Request $request){
            
            if ($request->filled('published_at')) {
                $published_at = carbon::parse($request->get('published_at'));
            } else {
               $published_at = null;
            }
            
         
                $this->validate($request,[
                    'title'=>'required',
                    'body'=>'required',
                    'category'=>'required',
                    'excerpt'=>'required',
                ]);
        
            $post->title = $request->get('title');
            $post->url =str::slug($request->get('title'));
            $post->body = $request->get('body');
            $post->excerpt = $request->get('excerpt');
          $post->published_at = $published_at;
            $post->category_id = $request->get('category');
            $post->save();
        // return Post::create($request->all())  ;
     
        //$post->tags()->attach($request->get('tags')); // attach duplica las etiquetas cunaod se actualiza
        $post->tags()->sync($request->get('tags')); // sync evita que se duplique
        return redirect()->route('admin.posts.edit',$post)->with('flash','Tu Publicacion ha sido Guardada');
         }

           
        

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostsController extends Controller
{


    public function etiquetas(){

        return "etiquetas";
    }
    public function index()
    {
        $posts = Post::latest()->get();
    
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categorias = Category::all();
        return view('admin.posts.create', compact('categorias', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'        => 'required|string|max:255',
            'body'         => 'nullable|string',
            'excerpt'      => 'nullable|string',
            'published_at' => 'nullable|date',
            'category_id'  => 'nullable|exists:categories,id',
        ]);

        // Crear slug único
        $slug = Str::slug($request->title);

        // Verificar si ya existe un post con el mismo slug
        $count = Post::where('url', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Crear el post
        $post = Post::create([
            'title'        => $request->title,
            'url'          => $slug,
            'excerpt'      => $request->excerpt,
            'body'         => $request->body,
            'published_at' => $request->filled('published_at') ? Carbon::parse($request->published_at) : null,
            'category_id'  => $request->category_id,
        ]);

        // Sincronizar etiquetas (si existen)
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash', 'La publicación se ha creado correctamente.');
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categorias = Category::all();
        return view('admin.posts.edit', compact('categorias', 'tags', 'post'));
    }

        public function delete(Post $post)
    {
   
        $post->delete();

        return redirect()->route('admin.posts.index')
                         ->with('success', 'El post fue eliminado correctamente.');
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
            'excerpt'      => 'required|string',
            'published_at' => 'nullable|date',
            'category_id'  => 'required|exists:categories,id',
        ]);

        $slug = Str::slug($request->title);

        // Evitar conflicto con otros slugs al editar
        if (Post::where('url', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug .= '-' . $post->id;
        }

        $post->update([
            'title'        => $request->title,
            'url'          => $slug,
            'body'         => $request->body,
            'excerpt'      => $request->excerpt,
            'published_at' => $request->filled('published_at') ? Carbon::parse($request->published_at) : null,
            'category_id'  => $request->category_id,
        ]);

        // Sincronizar etiquetas (evita duplicados)
        $post->tags()->sync($request->get('tags', []));

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash', 'Tu publicación ha sido actualizada correctamente.');
    }



}

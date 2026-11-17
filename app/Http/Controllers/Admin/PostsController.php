<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with(['category', 'tags'])->latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categorias = Category::all();
        return view('admin.posts.create', compact('categorias', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $slug = Str::slug($request->title);

        $count = Post::where('url', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $post = Post::create([
            'title'        => $request->title,
            'url'          => $slug,
            'excerpt'      => $request->excerpt,
            'body'         => $request->body,
            'published_at' => $request->filled('published_at') ? Carbon::parse($request->published_at) : null,
            'category_id'  => $request->category_id,
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash', 'La publicación se ha creado correctamente.');
    }

    public function edit(Post $post)
    {
        $post->load(['tags', 'photos']);
        $tags = Tag::all();
        $categorias = Category::all();
        return view('admin.posts.edit', compact('categorias', 'tags', 'post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $slug = Str::slug($request->title);

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

        $post->tags()->sync($request->get('tags', []));

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash', 'Tu publicación ha sido actualizada correctamente.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
                         ->with('success', 'El post fue eliminado correctamente.');
    }

    public function delete(Post $post)
    {
        return $this->destroy($post);
    }
}

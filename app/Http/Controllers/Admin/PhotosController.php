<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $path = $request->file('photo')->store('posts', 'public');
        $photoUrl = Storage::url($path);

        $photo = $post->photos()->create([
            'url' => $photoUrl,
        ]);

        return response()->json($photo, 201);
    }

    public function destroy(Photo $photo)
    {
        $relativePath = ltrim(str_replace('/storage', '', $photo->url), '/');
        Storage::disk('public')->delete($relativePath);

        $photo->delete();

        return back()->with('flash', 'Foto eliminada correctamente.');
    }
}

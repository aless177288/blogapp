<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
        
    // public function store(Post $post){
    //    $this->validate(request(), [
    //     'photo' => 'image|max:500'
    //    ]);

    //     $photo = request()->file('photo');
    // }
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'photo' => 'image|max:5000' 
        ]);
    
        $photo = $request->file('photo')->store('public');
          $photoUrl = Storage::url($photo);

       Photo::create([
        'url'=> $photoUrl,
        'post_id' => $post->id
       ]);

    }
    public function destroy(Photo $photo){
        $photo->delete();
        $photpath = str_replace('storage', 'public', $photo->url);
        Storage::delete($photpath);
       
        return back()->with('flash','foto eliminada');

    }
    
    // Resto del código para guardar la imagen en el servidor

}




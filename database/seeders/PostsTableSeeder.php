<?php

namespace Database\Seeders;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();
        Tag::truncate();
        
        $category = new Category;
        $category->name="categoria1";
        $category->save();
        $category = new Category;
        $category->name="categoria2";
        $category->save();
        $category = new Category;
        $category->name="categoria3";
        $category->save();
        $category = new Category;
        $category->name="categoria4";
        $category->save();


        $post = new Post;
        $post->title = "mi primer post";
        $post->url = str::slug("mi primer post");
        $post->excerpt = "mi primer contenido";
        $post->body = "<p>contenido de mi primer post</p>";
        $post->published_at = Carbon::now()->subDay(4);
        $post->category_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 1']));

        $post = new Post;
        $post->title = "mi segundo post";
        $post->url = str::slug("mi segundo post");
        $post->excerpt = "mi segundo contenido";
        $post->body = "<p>contenido de mi segundo post</p>";
        $post->published_at = Carbon::now()->subDay(2);
        $post->category_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 2']));

        $post = new Post;
        $post->title = "mi tercer post";
        $post->url = str::slug("mi tercer post");
        $post->excerpt = "mi tercer contenido";
        $post->body = "<p>contenido de mi tercer post</p>";
        $post->published_at = Carbon::now()->subDay(3);
        $post->category_id = 3;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'Etiqueta 3']));

        $post = new Post;
        $post->title = "mi cuarto post";
        $post->url = str::slug("mi cuarto post");
        $post->excerpt = "mi tercer contenido";
        $post->body = "<p>contenido de mi cuarto post</p>";
        $post->published_at = Carbon::now()->subDay(3);
        $post->category_id = 4;
        $post->save();

        $post->tags()->attach(Tag::create(['name'=>'Etiqueta4']));


    }
}

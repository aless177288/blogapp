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

    // Categorías
    $categories = [
        'Backend Development',
        'Frontend Development',
        'DevOps & Linux',
        'Internet of Things',
        'Artificial Intelligence',
        '3D Printing',
        'Electronics',
        'Personal Projects'
    ];

    foreach ($categories as $cat) {
        Category::create([
            'name' => $cat
        ]);
    }

    // Tags
    $tags = [
        'Laravel',
        'React',
        'FastAPI',
        'Linux',
        'ESP32',
        'MQTT',
        'Arduino',
        'Docker',
        'DigitalOcean',
        'Fusion 360'
    ];

    foreach ($tags as $tag) {
        Tag::create([
            'name' => $tag
        ]);
    }

    // Post
    $post = new Post;
    $post->title = "Mi primer post";
    $post->url = Str::slug("Mi primer post");
    $post->excerpt = "Mi primer contenido";
    $post->body = "<p>contenido de mi primer post</p>";
    $post->published_at = Carbon::now()->subDays(4);
    $post->category_id = 1;
    $post->save();

    // Asociar tags
    $post->tags()->attach([1,3,5]);

}
}

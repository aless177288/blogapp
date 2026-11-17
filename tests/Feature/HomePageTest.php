<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Category;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_returns_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_portfolio_page_returns_successful_response()
    {
        $response = $this->get('/portafolio');
        $response->assertStatus(200);
    }

    public function test_published_posts_are_visible_on_home_page()
    {
        $category = Category::create(['name' => 'Backend']);
        $post = Post::create([
            'title'        => 'Primer Post de Prueba',
            'url'          => 'primer-post-de-prueba',
            'excerpt'      => 'Extracto del post',
            'body'         => 'Cuerpo del post',
            'published_at' => now()->subDay(),
            'category_id'  => $category->id,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Primer Post de Prueba');
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_guests_cannot_access_posts_management()
    {
        $response = $this->get('/admin/posts');
        $response->assertRedirect('/login');
    }

    public function test_guests_cannot_access_post_creation_form()
    {
        $response = $this->get('/admin/posts/create');
        $response->assertRedirect('/login');
    }

    public function test_guests_cannot_store_a_post()
    {
        $response = $this->post('/admin/posts/store', [
            'title' => 'Hack Post',
            'body'  => 'Contenido malicioso',
        ]);
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_admin_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }
}

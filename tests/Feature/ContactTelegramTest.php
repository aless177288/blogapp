<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ContactTelegramTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_validates_required_fields()
    {
        $response = $this->post('/send-telegram', []);
        $response->assertSessionHasErrors(['name', 'whatsapp', 'message']);
    }

    public function test_contact_form_sends_telegram_message_successfully()
    {
        config([
            'services.telegram.bot_token' => 'dummy_token',
            'services.telegram.chat_id'   => 'dummy_chat_id',
        ]);

        Http::fake([
            'https://api.telegram.org/*' => Http::response(['ok' => true], 200),
        ]);

        $response = $this->post('/send-telegram', [
            'name'     => 'Reclutador Tech',
            'whatsapp' => '+521234567890',
            'message'  => 'Nos interesa tu perfil para una vacante de Laravel.',
        ]);

        $response->assertSessionHas('success');
        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'api.telegram.org');
        });
    }
}

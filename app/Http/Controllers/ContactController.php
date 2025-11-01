<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // 1. Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:100',
            'whatsapp' => 'required|max:100', // Campo para que puedas responder
            'message' => 'required|string|max:1000',
        ]);

        // 2. Obtener las credenciales del .env
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        
        // 3. Formatear el mensaje
        $message = "🌐 *Nuevo mensaje del Portafolio* 🌐\n\n"
                 . "👤 *De:* " . htmlspecialchars($request->name) . "\n"
                 . "📞 *Telefono Whats:* " . htmlspecialchars($request->whatsapp) . "\n"
                 . "💬 *Mensaje:*\n" . htmlspecialchars($request->message);

        // 4. Enviar el mensaje a Telegram
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown' // Usamos Markdown para negritas y emojis
        ]);

        // 5. Responder al usuario
        if ($response->successful()) {
            return redirect()->back()->with('success', '¡Tu mensaje ha sido enviado! Te contactaré pronto.');
        } else {
            // Si hay un error (ej. token incorrecto), el usuario es informado
            return redirect()->back()->with('error', 'Lo sentimos, hubo un error al enviar el mensaje. Intenta de nuevo.');
        }
    }
}

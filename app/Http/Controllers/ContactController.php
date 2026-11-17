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

        // 2. Obtener las credenciales desde config
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (!$token || !$chatId) {
            return redirect()->back()->with('error', 'El servicio de mensajería no está configurado actualmente.');
        }

        // 3. Formatear el mensaje en HTML seguro
        $name = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        $whatsapp = htmlspecialchars($request->whatsapp, ENT_QUOTES, 'UTF-8');
        $userMessage = htmlspecialchars($request->message, ENT_QUOTES, 'UTF-8');

        $message = "🌐 <b>Nuevo mensaje del Portafolio</b> 🌐\n\n"
                 . "👤 <b>De:</b> {$name}\n"
                 . "📞 <b>WhatsApp / Teléfono:</b> {$whatsapp}\n"
                 . "💬 <b>Mensaje:</b>\n{$userMessage}";

        // 4. Enviar el mensaje a Telegram
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
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

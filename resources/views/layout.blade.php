<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('meta-title', config('app.name', 'Esteban | Blog'))</title>
	<meta name="description" content="@yield('meta-description', 'Blog y portafolio sobre desarrollo web, programación y tecnología.')">
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/framework.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link rel="stylesheet" href="/css/ChatStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    
	@stack('styles')
</head>
<body>
	<div class="preload"></div>
	<header class="space-inter">
		<div class="container container-flex space-between">
			<figure class="logo">
				<a href="{{ route('home') }}">
					<img src="/img/esteban.png" alt="Logo Esteban">
				</a>
			</figure>
			<nav class="custom-wrapper" id="menu">
				<div class="pure-menu"></div>
				<ul class="container-flex list-unstyled">
					<li><a href="{{ route('home') }}" class="text-uppercase">Home</a></li>
					<li><a href="{{ route('portafolio') }}" class="text-uppercase">Portafolio</a></li>
					@auth
					<li><a href="{{ route('dashboard') }}" class="text-uppercase">Admin</a></li>
					@endauth
				</ul>
			</nav>
		</div>
	</header>
	
	@if(isset($categories) && $categories->count() > 0)
	<header class="space-inter2">
		<div class="container container-flex">
			<nav class="custom-wrapper">
				<ul class="container-flex list-unstyled1">
					@foreach($categories as $category)
					<li><a href="{{ route('category.show', $category) }}" class="text-uppercase">{{ $category->name }}</a></li>
					@endforeach
				</ul>
			</nav>
		</div>
	</header>
	@endif

	<main>
		{{-- Mensajes Flash --}}
		@if(session('success'))
			<div class="container" style="margin-top: 1rem;">
				<div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 6px; border-left: 4px solid #10b981;">
					{{ session('success') }}
				</div>
			</div>
		@endif

		@if(session('error'))
			<div class="container" style="margin-top: 1rem;">
				<div style="background-color: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 6px; border-left: 4px solid #ef4444;">
					{{ session('error') }}
				</div>
			</div>
		@endif

		{{-- Contenido dinámico --}}
		@yield('content')
	</main>

	<footer class="footer bg-gray-900 text-white py-6" style="background: #111827; color: #fff; padding: 2rem 0; margin-top: 3rem;">
		<div class="container mx-auto text-center" style="text-align: center;">
			<p class="mb-2">&copy; {{ date('Y') }} Esteban. Todos los derechos reservados.</p>
			<p class="mb-2">Proyectos y blog sobre desarrollo web, programación y tecnología.</p>
		</div>
	</footer>

	{{-- Botón y Popup de Telegram flotante --}}
	<div class="telegram-float" id="telegram-button" title="Enviar mensaje">
        <i class="fa-brands fa-telegram"></i>
    </div>

    <div class="chat-popup" id="telegram-chat" style="display: none;">
        <form action="{{ route('contact.send') }}" method="POST" class="chat-form-container">
            @csrf
            <div class="chat-header">
                <h4>¡Escríbeme!</h4>
                <button type="button" class="btn-close" id="close-chat">&times;</button>
            </div>

            <p style="font-size: 0.85rem; margin-bottom: 0.5rem;">Déjame un mensaje directo a mi Telegram.</p>
            
            <label for="name"><b>Nombre</b></label>
            <input type="text" placeholder="Tu nombre" name="name" id="name" required>

            <label for="whatsapp"><b>WhatsApp / Teléfono</b></label>
            <input type="text" placeholder="+52 ..." name="whatsapp" id="whatsapp" required>

            <label for="message"><b>Mensaje</b></label>
            <textarea placeholder="Escribe tu mensaje..." name="message" id="message" required></textarea>
			<button type="submit" class="btn">Enviar Mensaje</button>
        </form>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chatButton = document.getElementById('telegram-button');
            var chatPopup = document.getElementById('telegram-chat');
            var closeButton = document.getElementById('close-chat');

            if (chatButton && chatPopup && closeButton) {
                chatButton.addEventListener('click', function() {
                    chatPopup.style.display = 'block';
                    chatButton.style.display = 'none';
                });

                closeButton.addEventListener('click', function() {
                    chatPopup.style.display = 'none';
                    chatButton.style.display = 'block';
                });
            }
        });
    </script>
</body>
</html>

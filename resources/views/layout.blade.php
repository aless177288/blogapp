<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('meta-title','Esteban ' .'| blog')</title>
	<meta name="description" content="@yield('meta-description', 'Este es el Blog de Esteban')">
	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/css/framework.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/responsive.css">
	<link rel="stylesheet" href="/css/ChatStyle.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    
	@stack('styles')
	
</head>
<body>
	<div class="preload"></div>
	<header class="space-inter">
		<div class="container container-flex space-between">
			<figure class="logo"><img src="/img/esteban.png" alt=""></figure>
			<nav class="custom-wrapper" id="menu">
				<div class="pure-menu"></div>
				<ul class="container-flex list-unstyled">
					<li><a href="/" class="text-uppercase">Home</a></li>
					<li><a href="about.html" class="text-uppercase">About</a></li>
					<li><a href="archive.html" class="text-uppercase">Archive</a></li>
					<li><a href="contact.html" class="text-uppercase">Contact</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<header class="space-inter2">
		

			<div class="container container-flex space-between">
				<nav class="custom-wrapper" >
					<ul class="container-flex list-unstyled">
						@foreach($categories as $category)
					
						<li><a href="{{Route('category.show',$category)}}" class="text-uppercase">{{$category->name}}</a></li>
						@endforeach
						<!-- <div class="categoria">
						<span class="">{{$post->category->name}}</span>
					</div> -->
					</ul>
				</nav>
			</div>

</header>
    {{--  contenido dinamico   --}}



@yield('content')

  
    {{--  fin del contenido dinamico  --}}


    
	<section class="footer">
	<footer class="bg-gray-900 text-white py-6">
    <div class="container mx-auto text-center">
        <p class="mb-2">&copy; 2020 EstebanTech. Todos los derechos reservados.</p>
        <p class="mb-2">Proyectos y blog sobre desarrollo web, programación y tecnología.</p>
        <p class="text-sm text-gray-400">
            Sígueme en redes sociales o contáctame para colaboraciones y consultas.
        </p>
    </div>
</footer>
	</section>
	<!-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script> -->
	@stack('scripts')
	
<div class="telegram-float" id="telegram-button">
        <i class="fa-brands fa-telegram"></i>
    </div>

    <div class="chat-popup" id="telegram-chat">
        <form action="{{ route('contact.send') }}" method="POST" class="chat-form-container">
            @csrf <div class="chat-header">
                <h4>¡Escríbeme!</h4>
                <button type="button" class="btn-close" id="close-chat">X</button>
            </div>

            <p>Déjame un mensaje y te contactaré de vuelta.</p>
            
          <label for="name"><b>Nombre</b></label>
            <input type="text" placeholder="Tu nombre" name="name" required>

            <label for="whatsapp"><b>whatsapp</b></label>
            <input type="whatsapp" placeholder="123-45-50-> Whatsapp" name="whatsapp" required>

            <label for="message"><b>Mensaje</b></label>
            <textarea placeholder="Escribe tu mensaje..." name="message" required></textarea>
			<button type="submit" class="btn">Enviar</button>
        </form>
    </div>
    @stack('scripts') <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener los elementos
            var chatButton = document.getElementById('telegram-button');
            var chatPopup = document.getElementById('telegram-chat');
            var closeButton = document.getElementById('close-chat');

            // Mostrar chat al hacer clic en el botón
            chatButton.addEventListener('click', function() {
                chatPopup.style.display = 'block';
                chatButton.style.display = 'none'; // Ocultar el botón
            });

            // Ocultar chat al hacer clic en 'X'
            closeButton.addEventListener('click', function() {
                chatPopup.style.display = 'none';
                chatButton.style.display = 'block'; // Mostrar el botón de nuevo
            });
        });
    </script>

</body>
</html>
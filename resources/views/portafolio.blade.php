<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Esteban Valles | Portafolio</title>

    <!-- Google Fonts: Bebas Neue e Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Estilos de Tailwind -->
    <link rel="stylesheet" href="/css/newtailwind.css">
    <link rel="stylesheet" href="/css/app.css">

    <style>
        .bebas { font-family: 'Bebas Neue', cursive, sans-serif !important; letter-spacing: 0.05em; }
        .trebuchet, body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .card-icon i { font-size: 3rem; line-height: 1; }
        .aside-box .social-icon i { font-size: 1.5rem; }
    </style>
</head>
<body class="bg-scroll max-w-full">    

<header id="header" class="h-20 bg-black text-white bebas xs:h-36">
    <div class="container w-11/12 p-0 m-0 mx-auto flex md:flex-row xs:flex-col">
        <div id="logo" class="flex-1 xs:mx-auto">
            <a href="{{ route('home') }}" class="block">
                <div class="group w-64 pt-0.5 pb-0.5 mt-4 ml-6 text-center tracking-wider cursor-pointer overflow-hidden transition duration-300 rounded-sm bg-azulClaro hover:text-black hover:bg-gray-200">
                    <span class="block float-left text-2xl mt-1.5 ml-6">
                        <i class="fa-solid fa-code"></i>
                    </span>
                    <h3 class="block float-right text-3xl mt-1.5 mr-10 transition duration-100">
                        Esteban Valles
                    </h3>
                </div>
            </a>
        </div>
        <nav class="flex-1">
            <ul class="flex flex-row h-20 mr-6 items-center text-center text-2xl xs:mr-0 xs:text-center md:justify-end space-x-6">
                <li class="menu-item"><a href="{{ route('home') }}" class="menu-item-a hover:text-azulClaro transition">Blog</a></li>
                <li class="menu-item"><a href="{{ route('portafolio') }}" class="menu-item-a text-azulClaro font-semibold">Portafolio</a></li>
                @auth
                <li class="menu-item"><a href="{{ route('dashboard') }}" class="menu-item-a hover:text-azulClaro transition">Admin</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

{{-- Banner principal --}}
<section class="container w-11/12 mx-auto">
    <div id="banner" class="w-full h-28 mx-auto border-8 border-white overflow-hidden shadow m-5 bg-gradient-to-r from-azulObscuro to-azulClaro">
        <h1 class="text-white text-4xl font-normal tracking-wider m-7 mx-auto text-center bebas xs:text-2xl xs:mt-8">
            Desarrollador De Software & Web
        </h1>
    </div>

    <div class="flex flex-row justify-between min-h-[16rem] mb-12 xs:flex-col md:flex-row gap-6">
        {{-- Tarjeta Perfil / Avatar --}}
        <div class="w-72 xs:w-full flex-shrink-0">
            <div id="avatar" class="shadow rounded-lg p-6 bg-white border border-gray-100 text-center">
                <div class="w-36 h-36 mx-auto rounded-full overflow-hidden border-4 border-azulClaro shadow-md mb-4 bg-gray-50 flex items-center justify-center">
                    <img src="/img/esteban.png" alt="Esteban Valles" class="w-full h-full object-cover">
                </div>
                <h3 class="aside-header text-2xl bebas font-bold text-gray-800 tracking-wide">
                    Esteban Valles
                </h3>
                <p class="text-sm text-gray-500 font-medium">Full Stack Web & Mobile</p>
            </div>
        </div>

        {{-- Biografía --}}
        <div class="flex-1 bg-white p-6 rounded-lg shadow border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 bebas tracking-wide">
                Desarrollador de aplicaciones web y móviles
            </h2>
            <p class="text-base text-gray-700 leading-relaxed mb-4">
                Soy un desarrollador de aplicaciones web y móviles apasionado por crear soluciones digitales eficientes y efectivas para resolver problemas empresariales y personales. Con más de 5 años de experiencia, he tenido la oportunidad de trabajar en diferentes proyectos de desarrollo, adquiriendo sólidas habilidades en tecnologías modernas como <strong>Laravel, PHP, JavaScript, Docker, MySQL, PostgreSQL y Tailwind CSS</strong>.
            </p>
            <div id="more-text" style="display: none;">
                <p class="text-base text-gray-700 leading-relaxed mb-4">
                    Mi principal objetivo es proporcionar un servicio de calidad, asegurando que las ideas se conviertan en aplicaciones atractivas, seguras y de alto rendimiento. Me enfoco en escribir código limpio, arquitectura desacoplada, pruebas automatizadas y optimización para entornos de infraestructura en la nube.
                </p>
            </div>
            <button id="myBtn" class="px-4 py-2 bg-azulClaro hover:bg-azulObscuro text-white text-sm font-semibold rounded transition duration-200">
                Leer más
            </button>
        </div>
    </div>

    {{-- Tarjetas de Especialidades / Skills --}}
    <div id="cards" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-12">
        {{-- Tarjeta 1 --}}
        <div class="card group bg-white p-6 rounded-lg shadow hover:shadow-xl transition-all duration-300 text-center border-t-4 border-azulClaro">
            <span class="card-icon block mb-3 text-azulClaro group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-code"></i>
            </span>
            <h2 class="card-category text-xl bebas font-bold text-gray-800 mb-1">Desarrollo Web</h2>
            <span class="card-description text-xs text-gray-600 block">
                Laravel, PHP, Tailwind CSS, REST APIs
            </span>
        </div>

        {{-- Tarjeta 2 --}}
        <div class="card group bg-white p-6 rounded-lg shadow hover:shadow-xl transition-all duration-300 text-center border-t-4 border-indigo-500">
            <span class="card-icon block mb-3 text-indigo-500 group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-terminal"></i>
            </span>
            <h2 class="card-category text-xl bebas font-bold text-gray-800 mb-1">DevOps & Linux</h2>
            <span class="card-description text-xs text-gray-600 block">
                Docker, Nginx, Ubuntu Server, Bash
            </span>
        </div>

        {{-- Tarjeta 3 --}}
        <div class="card group bg-white p-6 rounded-lg shadow hover:shadow-xl transition-all duration-300 text-center border-t-4 border-blue-600">
            <span class="card-icon block mb-3 text-blue-600 group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-microchip"></i>
            </span>
            <h2 class="card-category text-xl bebas font-bold text-gray-800 mb-1">Hardware & IoT</h2>
            <span class="card-description text-xs text-gray-600 block">
                ESP32, Microcontroladores, Electrónica
            </span>
        </div>

        {{-- Tarjeta 4 --}}
        <div class="card group bg-white p-6 rounded-lg shadow hover:shadow-xl transition-all duration-300 text-center border-t-4 border-teal-500">
            <span class="card-icon block mb-3 text-teal-500 group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-network-wired"></i>
            </span>
            <h2 class="card-category text-xl bebas font-bold text-gray-800 mb-1">Redes & Cloud</h2>
            <span class="card-description text-xs text-gray-600 block">
                DigitalOcean, DNS, Reverse Proxy, SSL
            </span>
        </div>

        {{-- Tarjeta 5 --}}
        <div class="card group bg-white p-6 rounded-lg shadow hover:shadow-xl transition-all duration-300 text-center border-t-4 border-cyan-600">
            <span class="card-icon block mb-3 text-cyan-600 group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-database"></i>
            </span>
            <h2 class="card-category text-xl bebas font-bold text-gray-800 mb-1">Bases de Datos</h2>
            <span class="card-description text-xs text-gray-600 block">
                MySQL, MariaDB, PostgreSQL, Optimización
            </span>
        </div>
    </div>
</section>

{{-- Contenido Principal --}}
<main class="container w-11/12 mx-auto flex flex-row xs:flex-col md:flex-row gap-8">
    {{-- Columna Artículos / Proyectos --}}
    <section class="order-1 flex-grow">
        <h2 class="text-3xl font-bold mb-6 bebas tracking-wider text-gray-800 border-b-2 border-azulClaro pb-2">
            Últimos Artículos & Proyectos
        </h2>

        <article class="articles-container space-y-6">
            @forelse ($posts as $post)
            <div class="articles-items bg-white rounded-lg shadow p-6 border border-gray-100 hover:shadow-md transition">
                <div class="article-data text-xs text-gray-500 mb-2 flex items-center gap-4">
                    <span><i class="fa-regular fa-calendar mr-1 text-azulClaro"></i> {{ $post->published_at ? $post->published_at->format('d/m/Y') : 'Reciente' }}</span>
                    <span><i class="fa-solid fa-tag mr-1 text-azulClaro"></i> {{ optional($post->category)->name }}</span>
                </div>
                <h4 class="article-head text-2xl font-bold text-gray-800 mb-2 hover:text-azulClaro transition">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h4>
                <p class="article-description text-gray-600 text-sm leading-relaxed mb-4">
                    {{ $post->excerpt }}
                </p>
                <div class="read-more">
                    <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center text-sm font-semibold text-azulClaro hover:text-azulObscuro transition">
                        LEER MÁS <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center bg-white rounded shadow text-gray-500">
                No hay artículos disponibles por el momento.
            </div>
            @endforelse
        </article>
    </section>

    {{-- Barra Lateral (Sidebar) --}}
    <aside id="lateral" class="order-2 w-80 xs:w-full flex-none space-y-6">
        {{-- Contacto Telegram Directo --}}
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <h3 class="text-xl bebas font-bold text-gray-800 mb-3 border-b pb-2 flex items-center gap-2">
                <i class="fa-brands fa-telegram text-azulClaro text-2xl"></i> ¡Escríbeme!
            </h3>
            <p class="text-xs text-gray-600 mb-4">¿Tienes una propuesta o proyecto? Déjame un mensaje y te respondo de inmediato:</p>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="name" required class="w-full text-sm px-3 py-2 border rounded focus:border-azulClaro focus:outline-none" placeholder="Tu nombre">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">WhatsApp / Teléfono</label>
                    <input type="text" name="whatsapp" required class="w-full text-sm px-3 py-2 border rounded focus:border-azulClaro focus:outline-none" placeholder="+52 ...">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Mensaje</label>
                    <textarea name="message" rows="3" required class="w-full text-sm px-3 py-2 border rounded focus:border-azulClaro focus:outline-none" placeholder="¿En qué puedo ayudarte?"></textarea>
                </div>
                <button type="submit" class="w-full py-2 bg-azulClaro hover:bg-azulObscuro text-white text-sm font-bold rounded transition">
                    Enviar a Telegram
                </button>
            </form>
        </div>

        {{-- Redes Sociales --}}
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <h3 class="text-xl bebas font-bold text-gray-800 mb-4 border-b pb-2">
                Redes Profesionales
            </h3>
            <div class="flex flex-col space-y-3">
                <a href="https://github.com/aless177288" target="_blank" rel="noopener" class="flex items-center gap-3 px-4 py-2 bg-gray-900 text-white rounded hover:bg-black transition text-sm">
                    <i class="fa-brands fa-github text-lg"></i> GitHub
                </a>
                <a href="https://twitter.com/aless177288" target="_blank" rel="noopener" class="flex items-center gap-3 px-4 py-2 bg-blue-400 text-white rounded hover:bg-blue-500 transition text-sm">
                    <i class="fa-brands fa-x-twitter text-lg"></i> Twitter / X
                </a>
                <a href="https://www.facebook.com/profile.php?id=100093800427651" target="_blank" rel="noopener" class="flex items-center gap-3 px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800 transition text-sm">
                    <i class="fa-brands fa-facebook-f text-lg"></i> Facebook
                </a>
            </div>
        </div>
    </aside>
</main>

{{-- Pie de Página --}}
<footer id="footer" class="w-full bg-black text-white mt-16 pt-12 pb-8">
    <div class="container w-11/12 mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 text-sm">
        {{-- Menú --}}
        <div>
            <h5 class="text-xl bebas text-azulClaro mb-3 tracking-wider">Navegación</h5>
            <ul class="space-y-2 text-gray-400">
                <li><a href="{{ route('home') }}" class="hover:text-white transition">Blog</a></li>
                <li><a href="{{ route('portafolio') }}" class="hover:text-white transition">Portafolio</a></li>
                @auth
                <li><a href="{{ route('dashboard') }}" class="hover:text-white transition">Panel Admin</a></li>
                @else
                <li><a href="{{ route('login') }}" class="hover:text-white transition">Iniciar Sesión</a></li>
                @endauth
            </ul>
        </div>

        {{-- Ubicación --}}
        <div class="md:col-span-2">
            <h5 class="text-xl bebas text-azulClaro mb-3 tracking-wider">Ubicación</h5>
            <div class="w-full h-44 rounded overflow-hidden border border-gray-700">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d226577.63766109844!2d-99.7794447469298!3d27.460678413839023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8661187f41c4c78f%3A0x735d444f3ed3e91c!2sNuevo%20Laredo%2C%20Tamps.!5e0!3m2!1ses-419!2smx!4v1682383047622!5m2!1ses-419!2smx" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        {{-- Tecnologías --}}
        <div>
            <h5 class="text-xl bebas text-azulClaro mb-3 tracking-wider">Stack Tecnológico</h5>
            <div class="flex flex-wrap gap-3 text-2xl text-gray-400 mb-4">
                <i class="fa-brands fa-laravel text-red-500" title="Laravel"></i>
                <i class="fa-brands fa-php text-indigo-400" title="PHP 8.2"></i>
                <i class="fa-brands fa-docker text-blue-400" title="Docker"></i>
                <i class="fa-solid fa-database text-blue-300" title="MariaDB / MySQL"></i>
                <i class="fa-brands fa-js text-yellow-400" title="JavaScript"></i>
                <i class="fa-brands fa-html5 text-orange-500" title="HTML5"></i>
                <i class="fa-brands fa-css3-alt text-blue-500" title="CSS3"></i>
            </div>
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Esteban Valles - estebanvalles.info</p>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('myBtn');
        var more = document.getElementById('more-text');
        if (btn && more) {
            btn.addEventListener('click', function() {
                if (more.style.display === 'none') {
                    more.style.display = 'block';
                    btn.textContent = 'Leer menos';
                } else {
                    more.style.display = 'none';
                    btn.textContent = 'Leer más';
                }
            });
        }
    });
</script>
</body>
</html>

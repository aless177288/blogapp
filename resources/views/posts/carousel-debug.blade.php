<div class="carousel-container w-full max-w-xl mx-auto border-2 border-red-500 p-4">
    <div class="debug-info mb-4 p-2 bg-yellow-100 text-sm">
        <strong>Debug Info:</strong><br>
        - Total fotos: {{ $post->photos->count() }}<br>
        - Primer URL: {{ $post->photos->first()->url ?? 'No hay fotos' }}
    </div>

    {{-- Carrusel principal --}}
    <div class="carousel-slides relative aspect-video bg-gray-100 rounded-lg overflow-hidden shadow-md border-2 border-blue-500">
        @foreach($post->photos as $photo)
        <div class="carousel-slide absolute inset-0 w-full h-full transition-all duration-500 {{ $loop->first ? 'opacity-100' : 'opacity-0' }} border-2 border-green-500">
            <img src="{{ url($photo->url) }}" 
                 alt="Imagen {{ $loop->iteration }}"
                 class="w-full h-full object-cover"
                 onerror="console.error('Error loading image: {{ $photo->url }}')">
            <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white text-xs p-1 rounded">
                Imagen {{ $loop->iteration }}
            </div>
        </div>
        @endforeach
        
        {{-- Mensaje si no hay imágenes --}}
        @if($post->photos->count() === 0)
        <div class="flex items-center justify-center h-full text-gray-500">
            No hay imágenes para mostrar
        </div>
        @endif
    </div>

    {{-- Resto del código del carrusel... --}}
</div>
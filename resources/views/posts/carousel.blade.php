<div class="carousel-simple max-w-2xl mx-auto">
    {{-- Grid de imágenes --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
        @foreach($post->photos as $photo)
        <div class="aspect-square overflow-hidden rounded-lg shadow-sm">
            <img src="{{ url($photo->url) }}" 
                 alt="Imagen {{ $loop->iteration }}"
                 class="w-full h-full object-cover hover:scale-105 transition duration-300 cursor-pointer">
        </div>
        @endforeach
    </div>
    
    {{-- Información --}}
    <div class="text-center mt-3 text-gray-600 text-sm">
        {{ $post->photos->count() }} foto{{ $post->photos->count() > 1 ? 's' : '' }}
    </div>
</div>


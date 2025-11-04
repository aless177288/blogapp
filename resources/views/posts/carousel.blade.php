<div class="carousel-simple max-w-sm mx-auto">
    <div class="grid grid-cols-3 md:grid-cols-4 gap-2">  {{-- gap-2 en lugar de gap-1 --}}
        @foreach($post->photos as $photo)
        <div class="aspect-square overflow-hidden rounded-md shadow-sm">
            <img src="{{ url($photo->url) }}" 
                 alt="Imagen {{ $loop->iteration }}"
                 class="w-full h-full object-cover hover:scale-110 transition duration-200 cursor-pointer">
        </div>
        @endforeach
    </div>
    
    <div class="text-center mt-2 text-gray-500 text-xs">
        {{ $post->photos->count() }} foto{{ $post->photos->count() > 1 ? 's' : '' }}
    </div>
</div>
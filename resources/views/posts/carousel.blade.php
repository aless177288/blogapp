<div x-data="{ activeSlide: 0, slides: {{ $post->photos->count() }} }" class="relative w-full overflow-hidden rounded-xl shadow-md">

  {{-- Slides --}}
  <template x-for="(photo, index) in {{ $post->photos->toJson() }}" :key="index">
    <div x-show="activeSlide === index"
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="w-full h-80 md:h-[480px] bg-gray-200 flex justify-center items-center">
      <img :src="photo.url" class="object-cover w-full h-full" alt="Imagen del post">
    </div>
  </template>

  {{-- Controles --}}
  <button @click="activeSlide = (activeSlide === 0) ? slides - 1 : activeSlide - 1"
          class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-blue-600 p-2 rounded-full shadow">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
  </button>

  <button @click="activeSlide = (activeSlide + 1) % slides"
          class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-blue-600 p-2 rounded-full shadow">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
  </button>

  {{-- Indicadores --}}
  <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
    <template x-for="index in slides" :key="index">
      <button @click="activeSlide = index - 1"
              :class="activeSlide === index - 1 ? 'bg-blue-500' : 'bg-gray-300'"
              class="w-3 h-3 rounded-full transition-colors duration-300"></button>
    </template>
  </div>
</div>

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

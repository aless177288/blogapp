@extends('layout')

@section('meta-title', $post->title . ' | Esteban Blog')
@section('meta-description', $post->excerpt)

@push('styles')
    @if(file_exists(public_path('mix-manifest.json')))
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @endif
@endpush

@section('content')

<article class="post container">
    @if($post->photos->count() === 1)
        <div class="flex justify-center max-w-2xl mx-auto" style="margin-bottom: 2rem;">
            <figure class="w-full aspect-video bg-gray-100 rounded-lg overflow-hidden shadow-lg" style="text-align: center;">
                <img src="{{ $post->photos->first()->url }}" 
                     class="w-full h-full object-cover" 
                     style="max-width: 100%; height: auto; border-radius: 8px;"
                     alt="{{ $post->title }}">
            </figure>
        </div>
    @elseif($post->photos->count() > 1)
        <div class="flex justify-center my-6" style="margin-bottom: 2rem;">
            @include('posts.carousel')
        </div>
    @endif
		
    <div class="content-post">
        <header class="container-flex space-between">
            <div class="date">
                <span class="c-gris">{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</span>
            </div>
            <div class="post-category">
                <span class="category">{{ optional($post->category)->name }}</span>
            </div>
        </header>

        <h1>{{ $post->title }}</h1>
        <div class="divider"></div>

        <div class="image-w-text">
            {!! $post->body !!}
        </div>

        <footer class="container-flex space-between" style="margin-top: 2rem;">
            <div class="buttons-social-media-share">
                <ul class="share-buttons" style="display: flex; gap: 0.5rem; list-style: none; padding: 0;">
                    <li>
                        <a href="https://www.facebook.com/sharer.php?u={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}"
                           title="Compartir en Facebook" target="_blank" rel="noopener">
                            <img alt="Compartir en Facebook" src="/img/flat_web_icon_set/Facebook.png" style="width: 32px; height: 32px;">
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" 
                           target="_blank" rel="noopener" title="Compartir en X/Twitter">
                            <img alt="Tweet" src="/img/flat_web_icon_set/Twitter.png" style="width: 32px; height: 32px;">
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tags container-flex">
                @foreach ($post->tags as $tag)
                    <span class="tag c-gris" style="margin-left: 0.25rem;">#{{ $tag->name }}</span>
                @endforeach
            </div>
        </footer>
    </div>
</article>

@endsection

@extends('layout')

@section('content')

	<section class="posts container">
		
		@forelse($posts as $post)
        <article class="post">
			@if($post->photos->count() === 1)
				<figure>
					<a href="{{ route('posts.show', $post) }}">
						<img src="{{ $post->photos->first()->url }}" class="img-responsive" alt="{{ $post->title }}">
					</a>
				</figure>
			@endif
			
			<div class="content-post">
				<header class="container-flex space-between">
					<div class="date">
						<span class="c-gray-1">{{ $post->published_at ? $post->published_at->format('d M, Y') : '' }}</span>
					</div>
					<div class="post-category">
						<span class="category text-capitalize">{{ optional($post->category)->name }}</span>
					</div>
				</header>
				<h1><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h1>
				<div class="divider"></div>
				<p>{{ $post->excerpt }}</p>
				<footer class="container-flex space-between">
					<div class="read-more">
						<a href="{{ route('posts.show', $post) }}" class="btn-leer-mas">Leer Más</a>
					</div>
					<div class="tags container-flex">
                        @foreach($post->tags as $tag)
							<span class="tag c-gray-1 text-capitalize">#{{ $tag->name }}</span>
                        @endforeach
					</div>
				</footer>
			</div>
		</article>
		@empty
		<div class="container text-center" style="padding: 3rem 0; text-align: center;">
			<p>No hay publicaciones disponibles en este momento.</p>
		</div>
		@endforelse

	</section>

	@if($posts->hasPages())
	<div class="pagination" style="margin: 2rem 0; display: flex; justify-content: center;">
		{{ $posts->links() }}
	</div>
	@endif

@stop

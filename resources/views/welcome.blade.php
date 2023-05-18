@extends('layout')

@section('content')
	<section class="posts container">
		
@foreach($posts as $post)
        <article class="post">
			@if($post->photos->count() === 1)
			<figure ><img src="{{$post->photos->first()->url}}" class="img-responsive" alt="">
			</figure>
			@elseif($post->photos->count() > 1)
			<div class="gallery-photos" data-masonry='{"itemSelector":'.grid-item',"columnWidht":464}'>
				@foreach ($post->photos->take(4) as  $photo)
					
				<figure class="grid-item grid-item--height2">
					@if($loop->iteration ===4)
					<div class="overlay">{{$post->photos->count()}} Fotos</div>
					@endif
					<img src="{{url($photo->url)}}" alt="">
				</figure>
				@endforeach

			</div>
			@endif
			<div class="content-post">
				
				<header class="container-flex space-between">
					<div class="date">
						<span class="c-gray-1">{{$post->published_at}}</span>
					</div>
					<div class="post-category">
						<span class="category text-capitalize">{{$post->category->name}}</span>
					</div>
				</header>
				<h1>{{$post->title}}</h1>
				<div class="divider"></div>
				<p>{{$post->excerpt}}</p>
				<footer class="container-flex space-between">
					<div class="read-more">
						<a href="blog/{{$post->url}}" class="text-uppercase c-green">Leer Mas</a>
					</div>
					<div class="tags container-flex">
                        @foreach($post->tags as $tag)
						<span class="tag c-gray-1 text-capitalize">#{{$tag->name}}</span>
                        @endforeach
					</div>
				</footer>
			</div>
		</article>
@endforeach

	


		

	

{{--  	

		<article class="post image-w-text">
			<div class="content-post">
				<header class="container-flex space-between">
					<div class="date">
						<span class="c-gray-1">sep 11</span>
					</div>
					<div class="post-category">
						<span class="category">i do reflect</span>
					</div>
				</header>
				<h1>Democracy means simply the bludgeoning of the people by the people for the people.</h1>
				<div class="divider"></div>
				<div class="image-w-text-content">
					<figure class="block-left"><img src="img/img-post-2.png" alt=""></figure>
					<p>Quisque congue lacus mattis massa luctus, nec hendrerit purus aliquet. Ut ac elementum urna. Pellentesque suscipit metus et egestas congue. Duis eu pellentesque turpis, ut maximus metus. Sed ultrices tellus vitae rutrum congue. Fusce luctus augue id nisl suscipit, vel sollicitudin orci egestas. Morbi posuere venenatis ipsum, ac vestibulum quam dignissim efficitur. Ut vitae rutrum augue, in volutpat quam. Cras a viverra ipsum. Aenean ut consequat ex, vitae vulputate nunc. Vestibulum metus nisi, aliquam sed tincidunt sit amet, pretium et augue.</p>
					<p>Mauris sem odio, rhoncus eget euismod sed, pellentesque sit amet felis. Praesent dictum eleifend dui et efficitur. Nunc non orci in neque sodales semper. Etiam euismod volutpat lorem, vestibulum malesuada justo aliquet eget. Nunc lacus ante, varius a euismod eu, finibus commodo erat. Curabitur tincidunt sit amet nunc id interdum. Aliquam augue nisi, venenatis vitae ex at, lobortis fringilla nibh. Proin placerat enim vitae egestas eleifend. Aliquam</p>
					<p>quis orci dignissim, posuere nibh a, eleifend augue. Cras quis metus nec tortor aliquet ullamcorper. Quisque varius porta metus, ut maximus dolor euismod nec. Suspendisse sit amet feugiat turpis.</p>
					<cite class="cite-2">Curabitur ut leo pulvinar, consectetur magna eu, feugiat purus. Morbi hendrerit lectus turpis, a porttitor velit imperdiet id.</cite>
					<p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor. Nullam scelerisque ante mauris, egestas commodo nisi gravida ultrices. Suspendisse dapibus feugiat tincidunt. Aliquam gravida quam at ipsum sagittis bibendum. </p>
				</div>
				<footer class="container-flex space-between">
					<div class="read-more">
						<a href="#" class="text-uppercase c-green">read more</a>
					</div>
					<div class="tags container-flex">
						<span class="tag c-gray-1">#Democracy</span>
						<span class="tag c-gray-1">#Introspection</span>
					</div>
				</footer>
			</div>
		</article>  --}}

	</section><!-- fin del div.posts.container -->

	<div class="pagination">
		<ul class="list-unstyled container-flex space-center">
			<li><a href="#" class="pagination-active">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
		</ul>
	</div>
@stop
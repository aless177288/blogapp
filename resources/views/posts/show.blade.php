
@extends('layout')

@section('meta-title',$post->title)
@section('meta-description',$post->excerpt)


@section('content')
<article class="post container">
  @if($post->photos->count() === 1)
			<figure ><img src="{{$post->photos->first()->url}}" class="img-responsive" alt=""></figure>
      
     
      @elseif($post->photos->count() > 1)
      @include('posts.carousel')
      @endif
		
    <div class="content-post">
      <header class="container-flex space-between">
        <div class="date">
          <span class="c-gris">{{$post->published_at->format('M d')}}</span>
        </div>
        <div class="post-category">
          <span class="category">{{$post->category->name}}</span>
        </div>
      </header>
      <h1>{{$post->title}}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
        {!!$post->body!!}
        </div>

        <footer class="container-flex space-between">
          <div class="buttons-social-media-share">
            <ul class="share-buttons">
             

              <li><a href="https://www.facebook.com/sharer.php?u={{ urlencode(request()->fullUrl()) }} &title={{$post->title}}"
                title="Compartir en Facebook" target="_blank"><img alt="Compartir en Facebook" src="/img/flat_web_icon_set/Facebook.png"></a></li>
              <li><a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank"
                 title="Compartir en Tweet"><img alt="Tweet" src="/img/flat_web_icon_set/Twitter.png"></a></li>
              <li><a href="http://pinterest.com/pin/create/button/?url=&description=" target="_blank" title="compartir en Pinteres"><img alt="Pin it" src="/img/flat_web_icon_set/Pinterest.png"></a></li>
            </ul>
          </div>
          <div class="tags container-flex">
            @foreach ($post->tags as $tag )
                
            <span class="tag c-gris">#{{$tag->name}}</span>
            <span class="tag c-gris">#{{$tag->name}}</span>
            @endforeach
          </div>
      </footer>
      <div class="comments">
      <div class="divider"></div>
        <div id="disqus_thread"></div>
                                
      </div><!-- .comments -->
    </div>
  </article>
@endsection
@push('styles')
<link rel="stylesheet" href="/css/twitter-bootstrap.css">
@endpush

@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="/js/twitter-bootstrap.js"></script>
@endpush
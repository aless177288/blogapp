@extends('admin.layout')

@section('header')
@push('styles')
<link rel="stylesheet" type="text/css" href="/adminlte/datetimepicker/jquery.datetimepicker.css"/ >
<link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/dropzone.css" integrity="sha512-UrCkMTUH0evgGYJJ1Gb5XGuBXDrsSNoyN6Y6OecnEldtTg0TnqZACVJXyEY1wmvf6H8sKET/Yb85cG1xOjSnsw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@if ($post->photos->count())
<div class="col-md-12" >
  <div class="accordion" id="accordionExample">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" style="height: 10px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Imágenes
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="row">
            @foreach ($post->photos as $photo)
              <div class="col-md-2">
                <form method="POST" action="{{ route('admin.photos.destroy', ['photo' => $photo]) }}">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <div class="col">
                    <button type="submit" class="btn btn-danger btn-xs" style="position:absolute">x</button>
                    <img src="{{ url($photo->url) }}" class="img-fluid" alt="Responsive image">
                  </div>
                </form>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  
  </div>  
@endif

<div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0">Posts

      <small>Crear publicacion</small>
    </h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}"> <i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="breadcrumb-item active"><a href="{{route('admin.posts.index')}}"> <i class="fa fa-list"></i> Posts</a></li>
      <li class="breadcrumb-item active">crear</li>
    </ol>
  </div>
</div>

@stop

@section('content')
<form method="POST" action="{{ route('admin.posts.update',$post) }}" class="needs-validation" novalidate >
  @csrf {{method_field('PUT')}}
  <div class="row">
      <div class="col-md-8">
          <div class="card card-info">
              <div class="card-header">
                  <h3 class="card-title">Crear Publicación</h3>
              </div>
              <div class="card-body">
                  <div class="form-group ">
                      <label>Título de la Publicación</label>
                      <input name="title" value="{{old('title',$post->title)}}" type="text" class="form-control my-colorpicker1 {{$errors->has('title') ? 'is-invalid':''}}" placeholder="Ingresa aquí el título de la publicación" >
                     {!!$errors->first('title','  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        :message
                      </div>')!!}
                    

                  </div>
                  <div class="form-group">
                      <label>Contenido de la Publicación</label>
                      <textarea rows="10" id="editor" name="body"class="form-control my-colorpicker1 {{$errors->has('body') ? 'is-invalid':''}}" placeholder="Ingresa el contenido completo de la publicación" >{{old('body',$post->body)}}</textarea>
                      {!!$errors->first('body','  <div  class="invalid-feedback">
                        :message
                      </div>')!!}
                  </div>
                
              </div>
          </div>
      </div>
     
      <div class="col-md-4">
          <div class="card card-info">
              <div class="card-header">
                  <h3 class="card-title">Crear Publicación</h3>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <label>Fecha de Publicación</label>
                      <div class="input-group date" data-target-input="nearest">
                          <input type="text" value="{{ old('published_at', isset($post->published_at) ? $post->published_at->format('m/d/Y') : '') }}
                          " name="published_at" id="reservationdatetime" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                          <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  <div class="form-group ">
                      <label>Categorías</label>
                      <select id=""name="category" class="form-control {{$errors->has('category') ? 'is-invalid':''}}">
                          <option >Selecciona una Categoría</option>
                          @foreach ($categorias as $categoria)
                              <option value="{{ $categoria->id }}"
                                {{old('category',$post->category_id)== $categoria->id ? 'selected' : ''}}
                                >{{ $categoria->name }}</option>
                          @endforeach
                      </select>
                      {!!$errors->first('category','  <div  class="invalid-feedback">
                        :message
                      </div>')!!}
                  </div>
                  <div class="form-group">
                      <label>Etiquetas</label>
                      <select name="tags[]" class="select2"  multiple="multiple" data-placeholder="Selecciona una o más etiquetas" style="width: 100%;">
                          @foreach ($tags as $tag)
                              <option {{collect(old('tags',$post->tags->pluck('id')))->contains($tag->id) ? 'selected': ''}} value="{{ $tag->id }}">{{ $tag->name }}</option>
                          @endforeach
                      </select>
                     
                  </div>
                  <div class="form-group">
                      <label>Extracto de la Publicación</label>
                      <textarea name="excerpt" placeholder="Ingresa un extracto de la publicación }" class="form-control my-colorpicker1  {{$errors->has('excerpt') ? 'is-invalid':''}}">{{old('excerpt',$post->excerpt)}}</textarea>
                      {!!$errors->first('excerpt','  <div  class="invalid-feedback">
                        :message
                      </div>')!!}
                  </div>
                  <div class="form-grup">
                    <div class="dropzone">

                    </div>
                  </div>

                  <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>
         

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js" integrity="sha512-/dI6bSNIeJtFs3HvQbyWFDDqwxBNyTi+VDUIcP3bghK8bsaRjVNVIbrgd5mSrf1oAKP1qe9UIX+hIYzqpD+GTg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="/adminlte/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  
            let myDropzone = new Dropzone('.dropzone', {
                url: '{{ route("admin.posts.photos.store", ["post" => $post->url]) }}',
                paramName:'photo',
                acceptedFiles:'image/*',
                maxFilesize:5000,
                //maxFiles:1,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dictDefaultMessage: 'Arrastra las imágenes'
            });

            myDropzone.on('error', function(file, res){
            var msg = res.photo[0];
            $('.dz-error-message > span').text(msg);
            });

    {{--  new Dropzone('.dropzone',{
        url:'/admin/posts/{{$post->url}}/photos',
        dictDefaultMessage:'Arrastra las imagenes'
    });  --}}
    Dropzone.autoDiscover =false;

      $(function () {
        $('.select2').select2();
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
        CKEDITOR.replace( 'editor' );
        {{--  CKEDITOR.config.height = 315;  --}}
     
      
    });

    (function () {
        'use strict'
      
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
      
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }
      
              form.classList.add('was-validated')
            }, false)
          })
      })()

  </script>

  
  @endpush
@stop



@extends('admin.layout')

@section('header')
@push('styles')
<link rel="stylesheet" type="text/css" href="/adminlte/datetimepicker/jquery.datetimepicker.css"/ >
<link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endpush

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
<form method="POST" action="{{ route('admin.posts.store') }}" class="needs-validation" novalidate>
  @csrf
  <div class="row">
    <div class="col-md-8">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Crear Publicación</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Título de la Publicación</label>
            <input name="title" value="{{ old('title') }}" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Ingresa aquí el título de la publicación">
            {!! $errors->first('title','<div class="invalid-feedback">:message</div>') !!}
          </div>

          <div class="form-group">
            <label>Contenido de la Publicación</label>
            <textarea rows="10" id="editor" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Ingresa el contenido completo de la publicación">{{ old('body') }}</textarea>
            {!! $errors->first('body','<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Detalles de la Publicación</h3>
        </div>
        <div class="card-body">

          {{-- FECHA DE PUBLICACIÓN --}}
          <div class="form-group">
            <label>Fecha de Publicación</label>
            <div class="input-group date" data-target-input="nearest">
              <input type="text" value="{{ old('published_at') }}" name="published_at" id="reservationdatetime" class="form-control datetimepicker-input" data-target="#reservationdatetime">
              <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>

          {{-- CATEGORÍA --}}
          <div class="form-group">
            <label>Categoría</label>
            <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
              <option value="">Selecciona una Categoría</option>
              @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('category_id') == $categoria->id ? 'selected' : '' }}>
                  {{ $categoria->name }}
                </option>
              @endforeach
            </select>
            {!! $errors->first('category_id','<div class="invalid-feedback">:message</div>') !!}
          </div>

          {{-- ETIQUETAS --}}
          <div class="form-group">
            <label>Etiquetas</label>
            <select name="tags[]" class="select2" multiple="multiple" data-placeholder="Selecciona una o más etiquetas" style="width: 100%;">
              @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                  {{ $tag->name }}
                </option>
              @endforeach
            </select>
          </div>

          {{-- EXTRACTO --}}
          <div class="form-group">
            <label>Extracto de la Publicación</label>
            <textarea name="excerpt" class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" placeholder="Ingresa un extracto de la publicación">{{ old('excerpt') }}</textarea>
            {!! $errors->first('excerpt','<div class="invalid-feedback">:message</div>') !!}
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="/adminlte/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
 
      $(function () {
        $('.select2').select2();
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
        CKEDITOR.replace( 'editor' );
      
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



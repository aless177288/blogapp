
@extends('admin.layout')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection


@section('header')
{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  --}}

<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">todas las publicaciones</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">inicio</a></li>
        <li class="breadcrumb-item active">post</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->

  <div id="result"></div>
@stop
@section('content')
<button type="button" class="btn btn-primary right-button" data-toggle="modal" data-target="#exampleModal">
 + Crear Publicacion
</button>

<table id="posts-table" class="table table-bordered table-striped" style="width:100%">
  <thead>
      <tr>
          <th>id</th>
          <th>title</th>
          <th>Extracto</th>
          <th>Acciones</th>
        
      </tr>
  </thead>
            <tbody>
              @foreach($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->excerpt}}</td>
                <td>
                  <a href="{{route('posts.show', $post)}}"class="btn btn-xs btn-info btn-default"target="_blank" ><i class="fa fa-eye"></i></a>
                  <a href="{{route('admin.posts.edit',$post)}}"class="btn btn-xs btn-info" ><i class="fa fa-magic" aria-hidden="true"></i>
                  </a>
                  <a href="#"class="btn btn-xs btn-danger" ><i class="fa fa-times"></i></a>
                </td>

              </tr>
              @endforeach
            </tbody>
 
</table>
@section('js')
{{--  <script src="/adminlte/js/app.js"></script>  --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<style>
  .right-button {
    position: fixed;
    right: 20%;
    top: 20%;
    transform: translateY(-50%);
  }
</style>

<script>
  $(document).ready(function () {
    $('#posts-table').DataTable();
});
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" action="{{ route('admin.posts.store') }}" >
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <label>Título de la Publicación</label></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group ">
         
          <input name="title" value="{{old('title')}}" type="text" class="form-control my-colorpicker1 {{$errors->has('title') ? 'is-invalid':''}}" placeholder="Ingresa aquí el título de la publicación" >
         {!!$errors->first('title','  <div id="validationServerUsernameFeedback" class="invalid-feedback">
            :message
          </div>')!!}
        

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Crear Publicacion</button>
      </div>
    </div>
  </div>
  </form>
</div>

@endsection


@stop

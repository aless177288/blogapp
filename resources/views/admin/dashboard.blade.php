@extends('admin.layout')

@section('content')

        <h1>hola que haces</h1>
        <h1>usuario autenticado{{auth()->user()->name}}</h1>
        

@endsection
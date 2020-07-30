@extends('layouts.app')

@section('content')

    <h1>Cadastrar Post</h1>

    @include('includes.alerts')

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <input value="{{ old('name') }}" class="form-control" type="text" name="name" placeholder="Título">
        </div>
        <div class="form-group">
            <input class="form-control" type="file" name="image">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" cols="30" rows="5" placeholder="Conteúdo">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>

@endsection

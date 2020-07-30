@extends('layouts.app')

@section('content')

    <h1>Detalhes do post <b>{{ $rows->name }}</b></h1>

    <img src="{{ $rows->cover }}" alt="{{ $rows->name }}">

    <p>{{ $rows->description }}</p>

    <form action="{{ route('posts.destroy', $rows->id) }}" method="post">
        @csrf

        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" class="btn btn-danger">Deletar</button>
    </form>

@endsection

@extends('layouts.app')

@section('content')

    <h1>Detalhes do tenant <b>{{ $rows->name }}</b></h1>

    <img src="{{ $rows->cover }}" alt="{{ $rows->name }}">

    <p>{{ $rows->email }}</p>

    <form action="{{ route('tenants.destroy', $rows->id) }}" method="post">
        @csrf

        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" class="btn btn-danger">Deletar</button>
    </form>

@endsection

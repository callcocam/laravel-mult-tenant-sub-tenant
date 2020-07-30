@extends('layouts.app')

@section('content')

    <h1>{{ __("Detalhes Da Permissão") }} <b>{{ $rows->name }}</b></h1>

    <p>{{ $rows->description }}</p>

    <form action="{{ route('permissions.destroy', $rows->id) }}" method="post">
        @csrf

        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" class="btn btn-danger">{{ __("Deletar") }}</button>
    </form>

@endsection

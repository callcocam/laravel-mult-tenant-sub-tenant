@extends('layouts.app')

@section('content')

    <h1>Editar Tenant</h1>

    @include('includes.alerts')

    <form action="{{ route('tenants.update', $rows->id) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf

        <input type="hidden" name="id" value="{{ $rows->id }}">
        <div class="form-group">
            <input value="{{ old('name', $rows->name) }}" class="form-control" type="text" name="name" placeholder="Título">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>

@endsection

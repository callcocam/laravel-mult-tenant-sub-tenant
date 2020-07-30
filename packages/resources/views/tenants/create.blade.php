@extends('layouts.app')

@section('content')

    <h1>Cadastrar Tenant</h1>

    @include('includes.alerts')

    <form action="{{ route('tenants.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="asset" value="{{ $tenant->asset }}">
        <div class="form-group">
            <input value="{{ old('name') }}" class="form-control" type="text" name="name" placeholder="Título">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>

@endsection

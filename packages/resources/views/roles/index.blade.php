@extends('layouts.app')

@section('content')

    <h1>
        {{ __('Roles') }}
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-square"></i>
        </a>
    </h1>

    @include('includes.alerts')

    <ul class="media-list">

            @forelse($rows as $row)

            <li class="media">
                <div class="media-body">
            <span class="text-muted pull-right">
                <small class="text-muted">{{ $row->created_at->format('d/m/Y') }}</small>
            </span>
                    <p>
                        {{ $row->name }}
                        <br>
                        <a href="{{ route('roles.show', $row->id) }}">{{ __('Detalhes') }}</a> |
                        <a href="{{ route('roles.edit', $row->id) }}">{{ __('Editar') }}</a>
                    </p>
                </div>
            </li>
            <hr>
        @empty
            <li class="media">
                <p>{{ __("Nenhum Role Cadastrada") }}!</p>
            </li>
        @endforelse
    </ul>

@endsection

@extends('layouts.app')

@section('content')

    <h1>
        Tenants
        @if(!$tenant->tenant_id)
            <a href="{{ route('tenants.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-square"></i>
            </a>
        @endif
    </h1>

    @include('includes.alerts')

    <ul class="media-list">
        <li class="media">
            <div class="media-body">
            <span class="text-muted pull-right">
                <small class="text-muted">{{ $tenant->created_at->format('d/m/Y') }}</small>
            </span>
                <p>
                    {{ $tenant->name }}
                    <br>
                    @if(session()->has('tenant_id'))
                    <a href="{{ route('remove.tenant.tenants') }}">{{ __("Remover Tenant") }}</a> |
                    @endif
                    <a href="{{ route('tenants.show', $tenant->id) }}">Detalhes</a> |
                    <a href="{{ route('tenants.edit', $tenant->id) }}">Editar</a>
                </p>
            </div>
        </li>
        <hr>
        @can('view', $tenant)
            @forelse($tenant->filiais as $tenants)

                <li class="media">
                    <div class="media-body">
            <span class="text-muted pull-right">
                <small class="text-muted">{{ $tenants->created_at->format('d/m/Y') }}</small>
            </span>
                        <p>
                            {{ $tenants->name }}
                            <br>
                            <a href="{{ route('set.tenant.tenants', $tenants->id) }}">{{ __("Acessar Tenant") }}</a> |
                            <a href="{{ route('tenants.show', $tenants->id) }}">Detalhes</a> |
                            <a href="{{ route('tenants.edit', $tenants->id) }}">Editar</a>
                        </p>
                    </div>
                </li>
                <hr>
            @empty
                <li class="media">
                    <p>Nenhum tenants cadastrado!</p>
                </li>
            @endforelse
        @endcan
    </ul>

@endsection

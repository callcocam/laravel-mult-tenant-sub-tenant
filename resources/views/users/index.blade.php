@extends('layouts.app')

@section('content')

    <h1>
        Users
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-square"></i>
        </a>
    </h1>

    @include('includes.alerts')

    <div class="panel panel-default">
        <div class="panel-heading">
            Usuarios
        </div>

        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="10px">ID</th>
                    <th>Nombre</th>
                    <th colspan="3">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        @can('users.show')
                            <td width="10px">
                                <a href="{{ route('users.show', $row->id) }}"
                                   class="btn btn-sm btn-default">
                                    ver
                                </a>
                            </td>
                        @endcan
                        @can('users.edit')
                            <td width="10px">
                                <a href="{{ route('users.edit', $row->id) }}"
                                   class="btn btn-sm btn-default">
                                    editar
                                </a>
                            </td>
                        @endcan
                        @can('users.destroy')
                            <td width="10px">
                                {!! Form::open(['route' => ['users.destroy', $row->id],
                                'method' => 'DELETE']) !!}
                                <button class="btn btn-sm btn-danger">
                                    Eliminar
                                </button>
                                {!! Form::close() !!}
                            </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rows->render() }}
        </div>
    </div>

@endsection

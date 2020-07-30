@extends('layouts.app')

@section('content')
    @include('includes.alerts')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>{{ __("Cadastrar Permissão") }}</h1></div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'permissions.store']) }}

                    @include('tenant::permissions.partials.form')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection

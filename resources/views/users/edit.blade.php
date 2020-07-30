@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __("User") }}</div>
                    <div class="panel-body">
                        {!! Form::model($rows, ['route' => ['users.update', $rows->id],
                        'method' => 'PUT']) !!}
                        <input type="hidden" name="id" value="{{ $rows->id}}">
                        @include('users.partials.form',['email'=>true])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

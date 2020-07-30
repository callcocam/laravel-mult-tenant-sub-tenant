@include('includes.alerts')
<div class="form-group">
    {{ Form::label('name', 'Nome Do Usuário') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>

<div class="form-group">
    {{ Form::label('name', 'E-Mail Do Usuário') }}
    {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly' => $email]) }}
</div>
<div class="form-group">
    {{ Form::label('password', 'Senha') }}
    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
</div>
<hr>
<h3>{{ __("Lista De Roles") }}</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($roles as $role)
            <li>
                <label>
                    {{ Form::checkbox('roles[]', $role->id, null) }}
                    {{ $role->name }}
                    <em>({{ $role->description }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>
<div class="form-group">
    {{ Form::submit('Salvar', ['class' => 'btn btn-sm btn-primary']) }}
</div>

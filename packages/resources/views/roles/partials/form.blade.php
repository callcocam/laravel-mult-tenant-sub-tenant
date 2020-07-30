@include('includes.alerts')
<div class="form-group">
    {{ Form::label('name', 'Nome Da Role') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'URL Amigable') }}
    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<div class="form-group">
    {{ Form::label('description', 'Descripción') }}
    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
</div>
<hr>
<h3>Permiso especial</h3>
<div class="form-group">
    <label>{{ Form::radio('special', 'all-access') }} {{ __("Acesso Total") }}</label>
    <label>{{ Form::radio('special', 'no-access') }} {{ __("Nenhum Acesso") }}</label>
</div>
<hr>
<h3>{{ __("Lista De Permissões") }}</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach($permissions as $permission)
            <li>
                <label>
                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                    {{ $permission->name }}
                    <em>({{ $permission->description }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>

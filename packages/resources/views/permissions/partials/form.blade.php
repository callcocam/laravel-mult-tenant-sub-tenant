@include('includes.alerts')

<div class="form-group">
    {{ Form::label('name', 'Nome Da Permissão') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'Slug Da Permissão') }}
    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<h3>Grupo Da permissão</h3>
<div class="form-group">
    <label>{{ Form::radio('groups', 'index') }} {{ __("Listar") }}</label>
    <label>{{ Form::radio('groups', 'edit') }} {{ __("Editar") }}</label>
    <label>{{ Form::radio('groups', 'create') }} {{ __("Cadastrar") }}</label>
    <label>{{ Form::radio('groups', 'delete') }} {{ __("Excluir") }}</label>
    <label>{{ Form::radio('groups', 'view') }} {{ __("Visualizar") }}</label>
</div>
<div class="form-group">
    {{ Form::label('description', 'Descrição') }}
    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
</div>
<hr>
<h3>Situação Da Permissão</h3>
<div class="form-group">
    <label>{{ Form::radio('status', 'draft') }} {{ __("Rascunho") }}</label>
    <label>{{ Form::radio('status', 'published') }} {{ __("Publicado") }}</label>
</div>
<hr>
<div class="form-group">
    {{ Form::submit('Salvar', ['class' => 'btn btn-sm btn-primary']) }}
</div>

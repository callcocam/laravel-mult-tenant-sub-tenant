@csrf

<input type="hidden" name="id" {{ $post->id or old('id') }}>
<div class="form-group">
    <input value="{{ $post->name or old('name') }}" class="form-control" type="text" name="name" placeholder="Título">
</div>
<div class="form-group">
    <input class="form-control" type="file" name="image">
</div>
<div class="form-group">
    <textarea class="form-control" name="body" cols="30" rows="5" placeholder="Conteúdo">{{ $post->description or old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>

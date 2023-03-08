

{{-- Form --}}
@if ($project->exists)
  <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" novalidate>
    @method('PUT')
  @else
    <form action="{{ route('admin.projects.store') }}" method="POST" novalidate>
@endif


@csrf

<div class="row">
  <div class="col-6">
    <div class="mb-3">
      <label for="short_name" class="form-label">Nome titolo</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
        placeholder="Nome titolo" name="title" required value="{{ old('title', $project->title) }}">
        
    </div>
  </div>
  <div class="col-6">
    <div class="mb-3">
      <label for="image" class="form-label">url</label>
      <input type="url" class="form-control @error('image') is-invalid @enderror" id="image"
        placeholder="url" name="image" required value="{{ old('image', $project->image) }}">
      @error('image')
        <div class="invalid-feedback">
          {{ $msg }}
        </div>
      @else
        <div class="form-text">https:sdsjdksdlfjie.jpg</div>
      @enderror
    </div>
  </div>
  
  </div>
  <div class="col-12">
    <div class="mb-3">
      <label for="content" class="form-label">Descrizione</label>
      <textarea name="content" id="content" cols="30"
        class="form-control @error('content') is-invalid @enderror">{{ old('content', $project->content) }}</textarea>
    </div>
  </div>
  
<hr>
<div class="d-flex justify-content-end">
  <button type="submit" class="btn btn-success">Salva</button>
</div>
</form>

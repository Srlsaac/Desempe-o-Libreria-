@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $category->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea id="description" name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description ?? '') }}</textarea>
</div>

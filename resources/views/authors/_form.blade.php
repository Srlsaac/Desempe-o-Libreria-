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
           value="{{ old('name', $author->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="nationality" class="form-label">Nacionalidad</label>
    <input type="text" id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror"
           value="{{ old('nationality', $author->nationality ?? '') }}">
</div>

<div class="mb-3">
    <label for="bio" class="form-label">Biografía</label>
    <textarea id="bio" name="bio" rows="4"
              class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $author->bio ?? '') }}</textarea>
</div>

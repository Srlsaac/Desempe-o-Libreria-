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
    <label for="title" class="form-label">Título</label>
    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $book->title ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="author_id" class="form-label">Autor</label>
        <select id="author_id" name="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
            <option value="">Selecciona...</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @selected(old('author_id', $book->author_id ?? '') == $author->id)>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">Categoría</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">Selecciona...</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" id="isbn" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
               value="{{ old('isbn', $book->isbn ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label for="year" class="form-label">Año</label>
        <input type="number" id="year" name="year" class="form-control @error('year') is-invalid @enderror"
               value="{{ old('year', $book->year ?? '') }}">
    </div>

    <div class="col-md-4 mb-3">
        <label for="copies_total" class="form-label">Copias totales</label>
        <input type="number" id="copies_total" name="copies_total" min="1"
               class="form-control @error('copies_total') is-invalid @enderror"
               value="{{ old('copies_total', $book->copies_total ?? 1) }}" required>
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea id="description" name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="cover_image" class="form-label">Portada</label>
    @if (isset($book) && $book->cover_url)
        <div class="mb-2">
            <img src="{{ $book->cover_url }}" alt="Portada actual" class="thumb-cover-lg">
        </div>
    @endif
    <input type="file" id="cover_image" name="cover_image" accept="image/*"
           class="form-control @error('cover_image') is-invalid @enderror">
</div>

<div class="form-check mb-3">
    <input type="hidden" name="active" value="0">
    <input type="checkbox" id="active" name="active" value="1" class="form-check-input"
        @checked(old('active', $book->active ?? true))>
    <label for="active" class="form-check-label">Activo (visible en el catálogo)</label>
</div>

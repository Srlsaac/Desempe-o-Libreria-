<div class="card h-100 shadow-sm card-hover">
    <div class="cover-wrap">
        <div class="book-cover-placeholder"><i class="bi bi-book"></i></div>
        @if ($book->cover_url)
            <img src="{{ $book->cover_url }}" alt="Portada de {{ $book->title }}"
                 class="cover-img" onerror="this.remove()">
        @endif
    </div>

    <div class="card-body">
        <h5 class="card-title mb-1">{{ $book->title }}</h5>
        <p class="text-muted mb-2">{{ $book->author->name }}</p>
        <span class="badge rounded-pill text-bg-light border">{{ $book->category->name }}</span>
    </div>

    <div class="card-footer bg-transparent border-0 pb-3 d-flex justify-content-between align-items-center">
        @if ($book->copies_available > 0)
            <span class="badge text-bg-success">Disponible</span>
        @else
            <span class="badge text-bg-danger">Sin copias</span>
        @endif
        <a href="{{ route('catalog.show', $book) }}" class="btn btn-outline-primary btn-sm">Ver detalle</a>
    </div>
</div>

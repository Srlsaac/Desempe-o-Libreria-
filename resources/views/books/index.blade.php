@extends('layouts.bootstrap')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Libros</h1>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Nuevo libro</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                <tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>Copias</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/'.$book->cover_image) }}" alt="Portada"
                                     style="width: 50px; height: 70px; object-fit: cover;">
                            @else
                                <span class="text-muted">Sin portada</span>
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->copies_available }} / {{ $book->copies_total }}</td>
                        <td>
                            @if ($book->active)
                                <span class="badge text-bg-success">Activo</span>
                            @else
                                <span class="badge text-bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este libro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No hay libros.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection

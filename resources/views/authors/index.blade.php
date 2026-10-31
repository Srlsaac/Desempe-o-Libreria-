@extends('layouts.bootstrap')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Autores</h1>
        <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">Nuevo autor</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nacionalidad</th>
                    <th>Libros</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($authors as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->nationality }}</td>
                        <td>{{ $author->books_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este autor?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No hay autores.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $authors->links('pagination::bootstrap-5') }}
    </div>
@endsection

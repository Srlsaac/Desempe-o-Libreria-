@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Mis préstamos</h1>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                <tr>
                    <th>Libro</th>
                    <th>Autor</th>
                    <th>Estado</th>
                    <th>Fecha de préstamo</th>
                    <th>Vence</th>
                    <th>Devuelto</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->book->author->name }}</td>
                        <td><span class="badge text-bg-{{ $loan->statusColor() }}">{{ $loan->statusLabel() }}</span></td>
                        <td>{{ $loan->loan_date?->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ $loan->due_date?->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ $loan->return_date?->format('d/m/Y') ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Aún no tienes préstamos. <a href="{{ route('catalog.index') }}">Explora el catálogo</a>.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $loans->links('pagination::bootstrap-5') }}
    </div>
@endsection

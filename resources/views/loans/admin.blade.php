@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Préstamos</h1>

    @if ($vencidosCount > 0)
        <div class="alert alert-danger">
            Hay <strong>{{ $vencidosCount }}</strong> préstamo(s) vencido(s).
            <a href="{{ route('admin.loans.index', ['filtro' => 'vencidos']) }}" class="alert-link">Ver vencidos</a>
        </div>
    @endif

    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link {{ $filtro === null ? 'active' : '' }}" href="{{ route('admin.loans.index') }}">Todos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $filtro === 'pendientes' ? 'active' : '' }}" href="{{ route('admin.loans.index', ['filtro' => 'pendientes']) }}">Pendientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $filtro === 'activos' ? 'active' : '' }}" href="{{ route('admin.loans.index', ['filtro' => 'activos']) }}">Activos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $filtro === 'vencidos' ? 'active' : '' }}" href="{{ route('admin.loans.index', ['filtro' => 'vencidos']) }}">Vencidos</a>
        </li>
    </ul>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                <tr>
                    <th>Libro</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Vence</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->user->name }}</td>
                        <td><span class="badge text-bg-{{ $loan->statusColor() }}">{{ $loan->statusLabel() }}</span></td>
                        <td>{{ $loan->due_date?->format('d/m/Y') ?? '—' }}</td>
                        <td class="text-end">
                            @if ($loan->status === 'pending')
                                <form action="{{ route('admin.loans.approve', $loan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success">Aprobar</button>
                                </form>
                                <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-danger">Rechazar</button>
                                </form>
                            @elseif ($loan->status === 'active')
                                <form action="{{ route('admin.loans.return', $loan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-primary">Marcar devuelto</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No hay préstamos.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $loans->links('pagination::bootstrap-5') }}
    </div>
@endsection

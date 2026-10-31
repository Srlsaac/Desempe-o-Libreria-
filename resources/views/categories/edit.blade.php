@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Editar categoría</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                @include('categories._form')
                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection

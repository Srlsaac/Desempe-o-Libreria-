@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Editar libro</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('books._form')
                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection

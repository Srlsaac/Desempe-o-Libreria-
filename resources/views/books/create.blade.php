@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Nuevo libro</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('books._form')
                <button class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection

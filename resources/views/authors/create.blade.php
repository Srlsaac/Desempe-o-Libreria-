@extends('layouts.bootstrap')

@section('content')
    <h1 class="h3 mb-3">Nuevo autor</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.authors.store') }}" method="POST">
                @csrf
                @include('authors._form')
                <button class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection

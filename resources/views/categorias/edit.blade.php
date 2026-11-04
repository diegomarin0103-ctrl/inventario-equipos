@extends('layouts.app')

@section('title', 'Editar categoría')

@section('content')
    <h1 class="h3 mb-3"><i class="bi bi-pencil-square"></i> Editar categoría {{ $categoria->nombre }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                @include('categorias._form')
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Nueva categoría')

@section('content')
    <h1 class="h3 mb-3"><i class="bi bi-plus-circle"></i> Registrar categoría</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" method="POST" novalidate>
                @csrf
                @include('categorias._form')
            </form>
        </div>
    </div>
@endsection

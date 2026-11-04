@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="p-4 p-md-5 mb-4 bg-white rounded-3 shadow-sm">
        <h1 class="display-6 fw-semibold">Sistema de inventario de equipos tecnológicos</h1>
        <p class="lead text-muted mb-0">Controla los computadores, impresoras y demás dispositivos de la empresa, organizados por categoría.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h2 class="h5"><i class="bi bi-laptop text-primary"></i> Equipos</h2>
                    <p class="display-6 mb-1">{{ \App\Models\Equipo::count() }}</p>
                    <p class="text-muted">equipos registrados</p>
                    <a href="{{ route('equipos.index') }}" class="btn btn-primary">Ir a equipos</a>
                    <a href="{{ route('equipos.create') }}" class="btn btn-outline-primary">Registrar equipo</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h2 class="h5"><i class="bi bi-tags text-primary"></i> Categorías</h2>
                    <p class="display-6 mb-1">{{ \App\Models\Categoria::count() }}</p>
                    <p class="text-muted">categorías registradas</p>
                    <a href="{{ route('categorias.index') }}" class="btn btn-primary">Ir a categorías</a>
                    <a href="{{ route('categorias.create') }}" class="btn btn-outline-primary">Registrar categoría</a>
                </div>
            </div>
        </div>
    </div>
@endsection

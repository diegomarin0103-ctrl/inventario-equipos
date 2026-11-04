@extends('layouts.app')

@section('title', 'Detalle de la categoría')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0"><i class="bi bi-tag"></i> {{ $categoria->nombre }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Editar</a>
            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Descripción</dt>
                <dd class="col-sm-8">{{ $categoria->descripcion ?: '—' }}</dd>

                <dt class="col-sm-4">Ubicación</dt>
                <dd class="col-sm-8">{{ $categoria->ubicacion }}</dd>

                <dt class="col-sm-4">Estado</dt>
                <dd class="col-sm-8 mb-0">
                    <span class="badge text-bg-{{ $categoria->estado === 'activa' ? 'success' : 'secondary' }}">
                        {{ \App\Models\Categoria::ESTADOS[$categoria->estado] ?? $categoria->estado }}
                    </span>
                </dd>
            </dl>
        </div>
    </div>
@endsection

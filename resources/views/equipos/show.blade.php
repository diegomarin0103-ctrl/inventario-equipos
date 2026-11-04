@extends('layouts.app')

@section('title', 'Detalle del equipo')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0"><i class="bi bi-laptop"></i> {{ $equipo->nombre }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-primary"><i class="bi bi-pencil"></i> Editar</a>
            <a href="{{ route('equipos.index') }}" class="btn btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Código</dt>
                <dd class="col-sm-8">{{ $equipo->codigo }}</dd>

                <dt class="col-sm-4">Categoría</dt>
                <dd class="col-sm-8">
                    <a href="{{ route('categorias.show', $equipo->categoria) }}">{{ $equipo->categoria->nombre }}</a>
                    <span class="text-muted">({{ $equipo->categoria->ubicacion }})</span>
                </dd>

                <dt class="col-sm-4">Marca</dt>
                <dd class="col-sm-8">{{ $equipo->marca }}</dd>

                <dt class="col-sm-4">Modelo</dt>
                <dd class="col-sm-8">{{ $equipo->modelo }}</dd>

                <dt class="col-sm-4">Número de serie</dt>
                <dd class="col-sm-8"><code>{{ $equipo->numero_serie }}</code></dd>

                <dt class="col-sm-4">Estado</dt>
                <dd class="col-sm-8"><span class="badge text-bg-{{ $equipo->colorEstado() }}">{{ \App\Models\Equipo::ESTADOS[$equipo->estado] ?? $equipo->estado }}</span></dd>

                <dt class="col-sm-4">Fecha de adquisición</dt>
                <dd class="col-sm-8">{{ $equipo->fecha_adquisicion->format('d/m/Y') }}</dd>

                <dt class="col-sm-4">Registrado</dt>
                <dd class="col-sm-8 mb-0">{{ $equipo->created_at?->format('d/m/Y H:i') }}</dd>
            </dl>
        </div>
    </div>
@endsection

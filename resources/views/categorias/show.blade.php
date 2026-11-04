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

    <h2 class="h5 mb-3">Equipos de esta categoría ({{ $equipos->count() }})</h2>
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca / Modelo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipos as $equipo)
                        <tr>
                            <td><a href="{{ route('equipos.show', $equipo) }}">{{ $equipo->codigo }}</a></td>
                            <td>{{ $equipo->nombre }}</td>
                            <td>{{ $equipo->marca }} {{ $equipo->modelo }}</td>
                            <td><span class="badge text-bg-{{ $equipo->colorEstado() }}">{{ \App\Models\Equipo::ESTADOS[$equipo->estado] ?? $equipo->estado }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Esta categoría todavía no tiene equipos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

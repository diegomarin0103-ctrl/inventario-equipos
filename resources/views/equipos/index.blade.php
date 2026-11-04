@extends('layouts.app')

@section('title', 'Equipos')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0"><i class="bi bi-laptop"></i> Equipos tecnológicos</h1>
        <a href="{{ route('equipos.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nuevo equipo</a>
    </div>

    <form method="GET" action="{{ route('equipos.index') }}" class="row g-2 mb-3">
        <div class="col-sm-6 col-md-5">
            <input type="search" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por código, nombre, marca o serie">
        </div>
        <div class="col-sm-4 col-md-3">
            <select name="categoria_id" class="form-select" aria-label="Filtrar por categoría">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected($categoriaId == $categoria->id)>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary"><i class="bi bi-search"></i> Buscar</button>
            @if ($buscar || $categoriaId)
                <a href="{{ route('equipos.index') }}" class="btn btn-link">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Marca / Modelo</th>
                        <th>N.º de serie</th>
                        <th>Estado</th>
                        <th>Adquisición</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipos as $equipo)
                        <tr>
                            <td class="fw-semibold text-nowrap">{{ $equipo->codigo }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td><a href="{{ route('categorias.show', $equipo->categoria) }}" class="text-decoration-none">{{ $equipo->categoria->nombre }}</a></td>
                            <td>{{ $equipo->marca }} <span class="text-muted">{{ $equipo->modelo }}</span></td>
                            <td><code>{{ $equipo->numero_serie }}</code></td>
                            <td><span class="badge text-bg-{{ $equipo->colorEstado() }}">{{ \App\Models\Equipo::ESTADOS[$equipo->estado] ?? $equipo->estado }}</span></td>
                            <td>{{ $equipo->fecha_adquisicion->format('d/m/Y') }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar el equipo {{ $equipo->codigo }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No hay equipos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $equipos->links() }}
    </div>
@endsection

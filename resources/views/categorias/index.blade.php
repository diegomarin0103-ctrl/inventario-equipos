@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0"><i class="bi bi-tags"></i> Categorías de equipos</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nueva categoría</a>
    </div>

    <form method="GET" action="{{ route('categorias.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="search" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Buscar por nombre o ubicación">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary"><i class="bi bi-search"></i> Buscar</button>
            @if ($buscar)
                <a href="{{ route('categorias.index') }}" class="btn btn-link">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Ubicación</th>
                        <th class="text-center">Equipos</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr>
                            <td class="fw-semibold">{{ $categoria->nombre }}</td>
                            <td class="text-muted">{{ \Illuminate\Support\Str::limit($categoria->descripcion, 60) ?: '—' }}</td>
                            <td>{{ $categoria->ubicacion }}</td>
                            <td class="text-center"><a href="{{ route('equipos.index', ['categoria_id' => $categoria->id]) }}" class="badge rounded-pill text-bg-light border text-decoration-none">{{ $categoria->equipos_count }}</a></td>
                            <td>
                                <span class="badge text-bg-{{ $categoria->estado === 'activa' ? 'success' : 'secondary' }}">
                                    {{ \App\Models\Categoria::ESTADOS[$categoria->estado] ?? $categoria->estado }}
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar la categoría {{ $categoria->nombre }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay categorías registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categorias->links() }}
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipoRequest;
use App\Models\Categoria;
use App\Models\Equipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipoController extends Controller
{
    /** Consultar: lista de equipos con búsqueda, filtro por categoría y paginación. */
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');
        $categoriaId = $request->query('categoria_id');

        $equipos = Equipo::with('categoria')
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('codigo', 'like', "%{$buscar}%")
                        ->orWhere('nombre', 'like', "%{$buscar}%")
                        ->orWhere('marca', 'like', "%{$buscar}%")
                        ->orWhere('numero_serie', 'like', "%{$buscar}%");
                });
            })
            ->when($categoriaId, fn ($query, $id) => $query->where('categoria_id', $id))
            ->orderBy('codigo')
            ->paginate(10)
            ->withQueryString();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('equipos.index', compact('equipos', 'buscar', 'categorias', 'categoriaId'));
    }

    public function create(): View
    {
        return view('equipos.create', [
            'equipo' => new Equipo(['estado' => 'disponible']),
            'categorias' => $this->categoriasDisponibles(),
        ]);
    }

    /** Crear: guarda un equipo nuevo en MySQL. */
    public function store(EquipoRequest $request): RedirectResponse
    {
        Equipo::create($request->validated());

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function show(Equipo $equipo): View
    {
        $equipo->load('categoria');

        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo): View
    {
        return view('equipos.edit', [
            'equipo' => $equipo,
            'categorias' => $this->categoriasDisponibles($equipo->categoria_id),
        ]);
    }

    /** Actualizar: modifica un equipo existente. */
    public function update(EquipoRequest $request, Equipo $equipo): RedirectResponse
    {
        $equipo->update($request->validated());

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    /** Eliminar: borra el equipo (la confirmación se pide en la vista). */
    public function destroy(Equipo $equipo): RedirectResponse
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', "Equipo {$equipo->codigo} eliminado correctamente.");
    }

    /**
     * Categorías que se pueden elegir en el formulario: las activas
     * y, al editar, también la categoría actual del equipo.
     */
    private function categoriasDisponibles(?int $actualId = null)
    {
        return Categoria::where('estado', 'activa')
            ->when($actualId, fn ($q) => $q->orWhere('id', $actualId))
            ->orderBy('nombre')
            ->get();
    }
}

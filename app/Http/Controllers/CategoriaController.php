<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    /** Consultar: lista de categorías con el número de equipos de cada una. */
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');

        $categorias = Categoria::withCount('equipos')
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('ubicacion', 'like', "%{$buscar}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('categorias.index', compact('categorias', 'buscar'));
    }

    public function create(): View
    {
        return view('categorias.create', ['categoria' => new Categoria(['estado' => 'activa'])]);
    }

    /** Crear: guarda una categoría nueva en MySQL. */
    public function store(CategoriaRequest $request): RedirectResponse
    {
        Categoria::create($request->validated());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    /** Detalle de la categoría con la lista de sus equipos. */
    public function show(Categoria $categoria): View
    {
        $equipos = $categoria->equipos()->orderBy('codigo')->get();

        return view('categorias.show', compact('categoria', 'equipos'));
    }

    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    /** Actualizar: modifica una categoría existente. */
    public function update(CategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar: solo se permite si la categoría no tiene equipos asociados
     * (la base de datos también lo impide con la clave foránea).
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        $total = $categoria->equipos()->count();

        if ($total > 0) {
            return redirect()->route('categorias.index')
                ->with('error', "No se puede eliminar la categoría {$categoria->nombre} porque tiene {$total} equipo(s) asociado(s).");
        }

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', "Categoría {$categoria->nombre} eliminada correctamente.");
    }
}

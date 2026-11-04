<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    /** Consultar: lista de categorías con búsqueda y paginación. */
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');

        $categorias = Categoria::query()
            ->when($buscar, function ($query, $buscar) {
                $query->where('nombre', 'like', "%{$buscar}%")
                    ->orWhere('ubicacion', 'like', "%{$buscar}%");
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
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate($this->reglas());

        Categoria::create($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    public function show(Categoria $categoria): View
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    /** Actualizar: modifica una categoría existente. */
    public function update(Request $request, Categoria $categoria): RedirectResponse
    {
        $datos = $request->validate($this->reglas());

        $categoria->update($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /** Eliminar: borra la categoría (la confirmación se pide en la vista). */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    private function reglas(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'ubicacion' => ['required', 'string', 'max:150'],
            'estado' => ['required'],
        ];
    }
}

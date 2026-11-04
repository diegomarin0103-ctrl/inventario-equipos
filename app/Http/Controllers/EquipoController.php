<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipoController extends Controller
{
    /** Consultar: lista de equipos con búsqueda y paginación. */
    public function index(Request $request): View
    {
        $buscar = $request->query('buscar');

        $equipos = Equipo::query()
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('codigo', 'like', "%{$buscar}%")
                        ->orWhere('nombre', 'like', "%{$buscar}%")
                        ->orWhere('marca', 'like', "%{$buscar}%")
                        ->orWhere('numero_serie', 'like', "%{$buscar}%");
                });
            })
            ->orderBy('codigo')
            ->paginate(10)
            ->withQueryString();

        return view('equipos.index', compact('equipos', 'buscar'));
    }

    public function create(): View
    {
        return view('equipos.create', ['equipo' => new Equipo]);
    }

    /** Crear: guarda un equipo nuevo en MySQL. */
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate($this->reglas());

        Equipo::create($datos);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function show(Equipo $equipo): View
    {
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo): View
    {
        return view('equipos.edit', compact('equipo'));
    }

    /** Actualizar: modifica un equipo existente. */
    public function update(Request $request, Equipo $equipo): RedirectResponse
    {
        $datos = $request->validate($this->reglas());

        $equipo->update($datos);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    /** Eliminar: borra el equipo (la confirmación se pide en la vista). */
    public function destroy(Equipo $equipo): RedirectResponse
    {
        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }

    private function reglas(): array
    {
        return [
            'codigo' => ['required', 'string', 'max:30'],
            'nombre' => ['required', 'string', 'max:100'],
            'marca' => ['required', 'string', 'max:60'],
            'modelo' => ['required', 'string', 'max:60'],
            'numero_serie' => ['required', 'string', 'max:80'],
            'estado' => ['required'],
            'fecha_adquisicion' => ['required', 'date'],
        ];
    }
}

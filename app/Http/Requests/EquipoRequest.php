<?php

namespace App\Http\Requests;

use App\Models\Equipo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validaciones del formulario de equipos (crear y editar).
 */
class EquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Al editar, el propio equipo se excluye de la validación de "único".
        $equipoId = $this->route('equipo')?->id;

        return [
            'codigo' => ['required', 'string', 'max:30', Rule::unique('equipos', 'codigo')->ignore($equipoId)],
            'nombre' => ['required', 'string', 'max:100'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'marca' => ['required', 'string', 'max:60'],
            'modelo' => ['required', 'string', 'max:60'],
            'numero_serie' => ['required', 'string', 'max:80', Rule::unique('equipos', 'numero_serie')->ignore($equipoId)],
            'estado' => ['required', Rule::in(array_keys(Equipo::ESTADOS))],
            'fecha_adquisicion' => ['required', 'date', 'before_or_equal:today'],
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código del equipo',
            'nombre' => 'nombre del equipo',
            'categoria_id' => 'categoría',
            'marca' => 'marca',
            'modelo' => 'modelo',
            'numero_serie' => 'número de serie',
            'estado' => 'estado',
            'fecha_adquisicion' => 'fecha de adquisición',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_adquisicion.before_or_equal' => 'La fecha de adquisición no puede ser posterior a hoy.',
        ];
    }
}

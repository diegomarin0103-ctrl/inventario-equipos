<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validaciones del formulario de categorías (crear y editar).
 */
class CategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoriaId = $this->route('categoria')?->id;

        return [
            'nombre' => ['required', 'string', 'max:100', Rule::unique('categorias', 'nombre')->ignore($categoriaId)],
            'descripcion' => ['nullable', 'string', 'max:500'],
            'ubicacion' => ['required', 'string', 'max:150'],
            'estado' => ['required', Rule::in(array_keys(Categoria::ESTADOS))],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre de la categoría',
            'descripcion' => 'descripción',
            'ubicacion' => 'ubicación',
            'estado' => 'estado',
        ];
    }
}

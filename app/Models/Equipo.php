<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    /** Estados permitidos para un equipo. */
    public const ESTADOS = [
        'disponible' => 'Disponible',
        'asignado' => 'Asignado',
        'mantenimiento' => 'Mantenimiento',
    ];

    protected $fillable = [
        'codigo',
        'nombre',
        'marca',
        'modelo',
        'numero_serie',
        'estado',
        'fecha_adquisicion',
        'categoria_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha_adquisicion' => 'date',
        ];
    }

    /** Cada equipo pertenece a una categoría. */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /** Clase de Bootstrap para pintar el estado. */
    public function colorEstado(): string
    {
        return match ($this->estado) {
            'disponible' => 'success',
            'asignado' => 'primary',
            'mantenimiento' => 'warning',
            default => 'secondary',
        };
    }
}

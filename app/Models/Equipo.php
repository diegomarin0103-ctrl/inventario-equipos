<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected function casts(): array
    {
        return [
            'fecha_adquisicion' => 'date',
        ];
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

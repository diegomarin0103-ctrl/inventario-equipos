<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    /** Estados permitidos para una categoría. */
    public const ESTADOS = [
        'activa' => 'Activa',
        'inactiva' => 'Inactiva',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'ubicacion',
        'estado',
    ];

    /** Una categoría tiene muchos equipos. */
    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class);
    }
}

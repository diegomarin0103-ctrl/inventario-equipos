<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(): array
    {
        return [
            'nombre' => 'Categoría '.fake()->unique()->numberBetween(1, 99999),
            'descripcion' => fake()->sentence(),
            'ubicacion' => 'Bodega '.fake()->numberBetween(1, 5),
            'estado' => 'activa',
        ];
    }
}

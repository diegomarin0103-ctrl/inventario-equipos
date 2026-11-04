<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Equipo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Equipo>
 */
class EquipoFactory extends Factory
{
    protected $model = Equipo::class;

    public function definition(): array
    {
        return [
            'codigo' => 'EQ-'.fake()->unique()->numberBetween(100, 99999),
            'nombre' => fake()->randomElement(['Portátil', 'Impresora', 'Monitor', 'Router']).' '.fake()->word(),
            'marca' => fake()->randomElement(['HP', 'Lenovo', 'Dell', 'Epson']),
            'modelo' => strtoupper(fake()->bothify('??-###')),
            'numero_serie' => strtoupper(fake()->unique()->bothify('SN########')),
            'estado' => fake()->randomElement(array_keys(Equipo::ESTADOS)),
            'fecha_adquisicion' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'categoria_id' => Categoria::factory(),
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Equipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipoCrudTest extends TestCase
{
    use RefreshDatabase;

    private function datosValidos(array $cambios = []): array
    {
        return array_merge([
            'codigo' => 'EQ-100',
            'nombre' => 'Portátil de prueba',
            'categoria_id' => Categoria::factory()->create()->id,
            'marca' => 'Lenovo',
            'modelo' => 'ThinkPad E14',
            'numero_serie' => 'SN123456',
            'estado' => 'disponible',
            'fecha_adquisicion' => '2025-01-15',
        ], $cambios);
    }

    public function test_muestra_el_listado_con_la_categoria(): void
    {
        $equipo = Equipo::factory()->create(['nombre' => 'Impresora láser']);

        $this->get(route('equipos.index'))
            ->assertOk()
            ->assertSee('Impresora láser')
            ->assertSee($equipo->categoria->nombre);
    }

    public function test_crea_un_equipo(): void
    {
        $this->post(route('equipos.store'), $this->datosValidos())
            ->assertRedirect(route('equipos.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('equipos', ['codigo' => 'EQ-100', 'numero_serie' => 'SN123456']);
    }

    public function test_valida_campos_obligatorios(): void
    {
        $this->post(route('equipos.store'), [])
            ->assertSessionHasErrors([
                'codigo', 'nombre', 'categoria_id', 'marca', 'modelo',
                'numero_serie', 'estado', 'fecha_adquisicion',
            ]);
    }

    public function test_valida_tipos_de_datos(): void
    {
        $this->post(route('equipos.store'), $this->datosValidos([
            'categoria_id' => 9999,          // no existe
            'estado' => 'perdido',           // no es un estado permitido
            'fecha_adquisicion' => 'ayer',   // no es una fecha
        ]))->assertSessionHasErrors(['categoria_id', 'estado', 'fecha_adquisicion']);

        $this->post(route('equipos.store'), $this->datosValidos([
            'fecha_adquisicion' => now()->addDay()->toDateString(), // fecha futura
        ]))->assertSessionHasErrors('fecha_adquisicion');

        $this->assertDatabaseCount('equipos', 0);
    }

    public function test_codigo_y_serie_deben_ser_unicos(): void
    {
        Equipo::factory()->create(['codigo' => 'EQ-100', 'numero_serie' => 'SN123456']);

        $this->post(route('equipos.store'), $this->datosValidos())
            ->assertSessionHasErrors(['codigo', 'numero_serie']);
    }

    public function test_actualiza_un_equipo(): void
    {
        $equipo = Equipo::factory()->create();

        $this->put(route('equipos.update', $equipo), $this->datosValidos([
            'codigo' => $equipo->codigo,
            'numero_serie' => $equipo->numero_serie,
            'estado' => 'mantenimiento',
        ]))->assertRedirect(route('equipos.index'));

        $this->assertDatabaseHas('equipos', ['id' => $equipo->id, 'estado' => 'mantenimiento']);
    }

    public function test_elimina_un_equipo(): void
    {
        $equipo = Equipo::factory()->create();

        $this->delete(route('equipos.destroy', $equipo))
            ->assertRedirect(route('equipos.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('equipos', ['id' => $equipo->id]);
    }
}

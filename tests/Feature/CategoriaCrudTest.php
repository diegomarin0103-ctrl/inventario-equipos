<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Equipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_muestra_el_listado_de_categorias(): void
    {
        Categoria::factory()->create(['nombre' => 'Impresoras']);

        $this->get(route('categorias.index'))
            ->assertOk()
            ->assertSee('Impresoras');
    }

    public function test_crea_una_categoria(): void
    {
        $this->post(route('categorias.store'), [
            'nombre' => 'Computadores',
            'descripcion' => 'Portátiles y equipos de escritorio',
            'ubicacion' => 'Piso 2',
            'estado' => 'activa',
        ])->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categorias', ['nombre' => 'Computadores', 'ubicacion' => 'Piso 2']);
    }

    public function test_valida_campos_obligatorios_y_estado(): void
    {
        $this->post(route('categorias.store'), [
            'nombre' => '',
            'ubicacion' => '',
            'estado' => 'otro',
        ])->assertSessionHasErrors(['nombre', 'ubicacion', 'estado']);

        $this->assertDatabaseCount('categorias', 0);
    }

    public function test_no_permite_nombres_repetidos(): void
    {
        Categoria::factory()->create(['nombre' => 'Redes']);

        $this->post(route('categorias.store'), [
            'nombre' => 'Redes',
            'ubicacion' => 'Piso 1',
            'estado' => 'activa',
        ])->assertSessionHasErrors('nombre');
    }

    public function test_actualiza_una_categoria(): void
    {
        $categoria = Categoria::factory()->create();

        $this->put(route('categorias.update', $categoria), [
            'nombre' => $categoria->nombre,
            'descripcion' => 'Nueva descripción',
            'ubicacion' => 'Bodega central',
            'estado' => 'inactiva',
        ])->assertRedirect(route('categorias.index'));

        $this->assertDatabaseHas('categorias', [
            'id' => $categoria->id,
            'ubicacion' => 'Bodega central',
            'estado' => 'inactiva',
        ]);
    }

    public function test_elimina_una_categoria_sin_equipos(): void
    {
        $categoria = Categoria::factory()->create();

        $this->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('categorias', ['id' => $categoria->id]);
    }

    public function test_no_elimina_una_categoria_con_equipos(): void
    {
        $equipo = Equipo::factory()->create();

        $this->delete(route('categorias.destroy', $equipo->categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('categorias', ['id' => $equipo->categoria_id]);
    }
}

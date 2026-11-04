<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Equipo;
use Illuminate\Database\Seeder;

/**
 * Datos de prueba para demostrar el funcionamiento del sistema.
 * Ejecutar con: php artisan migrate --seed  (o php artisan db:seed)
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'computadores' => Categoria::create([
                'nombre' => 'Computadores',
                'descripcion' => 'Equipos de escritorio y portátiles para el personal.',
                'ubicacion' => 'Oficina de sistemas - Piso 2',
                'estado' => 'activa',
            ]),
            'impresoras' => Categoria::create([
                'nombre' => 'Impresoras',
                'descripcion' => 'Impresoras láser, de tinta y multifuncionales.',
                'ubicacion' => 'Centro de copiado - Piso 1',
                'estado' => 'activa',
            ]),
            'redes' => Categoria::create([
                'nombre' => 'Redes y conectividad',
                'descripcion' => 'Routers, switches y puntos de acceso inalámbrico.',
                'ubicacion' => 'Cuarto de comunicaciones',
                'estado' => 'activa',
            ]),
            'audiovisuales' => Categoria::create([
                'nombre' => 'Audiovisuales',
                'descripcion' => 'Video beams, pantallas y parlantes para salas de reuniones.',
                'ubicacion' => 'Bodega piso 3',
                'estado' => 'activa',
            ]),
            'perifericos' => Categoria::create([
                'nombre' => 'Periféricos',
                'descripcion' => 'Monitores, teclados, mouse y escáneres.',
                'ubicacion' => 'Bodega piso 3',
                'estado' => 'inactiva',
            ]),
        ];

        $equipos = [
            ['EQ-001', 'Portátil administrativo', 'Lenovo', 'ThinkPad E14', 'PF3K9X21', 'asignado', '2024-02-15', 'computadores'],
            ['EQ-002', 'Portátil de soporte', 'Dell', 'Latitude 5440', 'DL5440A88', 'disponible', '2024-06-03', 'computadores'],
            ['EQ-003', 'PC de escritorio contabilidad', 'HP', 'ProDesk 400 G9', 'MXL2231B7Q', 'asignado', '2023-09-20', 'computadores'],
            ['EQ-004', 'PC de escritorio recepción', 'Lenovo', 'ThinkCentre M70s', 'MJ0FK2LP', 'mantenimiento', '2022-11-11', 'computadores'],
            ['EQ-005', 'MacBook diseño', 'Apple', 'MacBook Air M2', 'C02HX3JKQ6L4', 'asignado', '2025-01-28', 'computadores'],
            ['EQ-006', 'Impresora láser gerencia', 'HP', 'LaserJet Pro M404dn', 'VNB3K12345', 'disponible', '2023-03-14', 'impresoras'],
            ['EQ-007', 'Multifuncional de tinta', 'Epson', 'EcoTank L6270', 'X8HN004512', 'asignado', '2024-08-09', 'impresoras'],
            ['EQ-008', 'Impresora de etiquetas', 'Zebra', 'ZD421', 'D4J212300987', 'mantenimiento', '2022-05-30', 'impresoras'],
            ['EQ-009', 'Router principal', 'MikroTik', 'RB4011', 'HE3089KL221', 'asignado', '2023-07-01', 'redes'],
            ['EQ-010', 'Switch 24 puertos', 'Cisco', 'CBS250-24T', 'FOC2533Y0AB', 'asignado', '2023-07-01', 'redes'],
            ['EQ-011', 'Access point piso 2', 'Ubiquiti', 'UniFi U6 Lite', 'U6L7845210', 'disponible', '2025-04-17', 'redes'],
            ['EQ-012', 'Video beam sala de juntas', 'Epson', 'PowerLite X49', 'X5QK7700123', 'disponible', '2024-10-05', 'audiovisuales'],
            ['EQ-013', 'Monitor 24 pulgadas', 'Samsung', 'S24C310', 'ZZB4H4MW600', 'disponible', '2024-03-22', 'perifericos'],
        ];

        foreach ($equipos as [$codigo, $nombre, $marca, $modelo, $serie, $estado, $fecha, $categoria]) {
            Equipo::create([
                'codigo' => $codigo,
                'nombre' => $nombre,
                'marca' => $marca,
                'modelo' => $modelo,
                'numero_serie' => $serie,
                'estado' => $estado,
                'fecha_adquisicion' => $fecha,
                'categoria_id' => $categorias[$categoria]->id,
            ]);
        }
    }
}

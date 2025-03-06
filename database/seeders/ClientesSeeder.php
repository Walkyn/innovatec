<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $nombres = ['Juan', 'María', 'Carlos', 'Ana', 'Luis', 'Sofía', 'Pedro', 'Laura', 'Diego', 'Elena', 'Miguel', 'Valeria', 'Andrés', 'Gabriela', 'Fernando'];
        $apellidos = ['Gómez', 'Martínez', 'Rodríguez', 'Fernández', 'Pérez', 'López', 'Gutiérrez', 'Díaz', 'Herrera', 'Jiménez', 'Morales', 'Ruiz', 'Torres', 'Vargas', 'Ramos'];
        $direcciones = [
            'Av. Siempre Viva 742', 'Calle del Sol 123', 'Av. Libertad 456', 'Calle Mayor 78', 'Pasaje San Martín 987',
            'Boulevard Central 654', 'Camino del Río 321', 'Callejón de los Sueños 111', 'Paseo del Prado 222',
            'Ruta 66, Km 10', 'Av. de la Paz 789', 'Calle de las Rosas 555', 'Barrio Nuevo 333', 'Sector Norte 999',
            'Residencial Los Álamos 777'
        ];

        $clientes = [];

        for ($i = 0; $i < 15; $i++) {
            $clientes[] = [
                'nombres' => $nombres[$i],
                'apellidos' => $apellidos[$i],
                'identificacion' => strtoupper(Str::random(10)),
                'telefono' => '+1 555-' . rand(1000, 9999),
                'direccion' => $direcciones[$i] . ', Ciudad ' . rand(1, 10),
                'gps' => null,
                'region_id' => rand(1, 5),
                'provincia_id' => rand(1, 10),
                'distrito_id' => rand(1, 20),
                'pueblo_id' => null,
                'estado_cliente' => ['activo', 'inactivo', 'suspendido'][rand(0, 2)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('clientes')->insert($clientes);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargosSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = [
            'Gerente',
            'Administrador',
            'Vendedor',
            'Encargado de almacén',
            'Supervisor',
        ];

        foreach ($cargos as $cargo) {
            Cargo::firstOrCreate([
                'nombre' => $cargo,
            ]);
        }
    }
}
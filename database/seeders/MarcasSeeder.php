<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            'Toyota',
            'Ford',
            'Chevrolet',
            'Hyundai',
            'Nissan',
        ];

        foreach ($marcas as $nombre) {
            Marca::updateOrCreate(
                ['nombre' => $nombre],
                ['activo' => true]
            );
        }
    }
}

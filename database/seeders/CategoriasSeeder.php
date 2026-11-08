<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Motor', 'descripcion' => 'Componentes y accesorios del motor.'],
            ['nombre' => 'Frenos', 'descripcion' => 'Sistemas y componentes de frenado.'],
            ['nombre' => 'Suspensión', 'descripcion' => 'Componentes de suspensión y amortiguación.'],
            ['nombre' => 'Transmisión', 'descripcion' => 'Componentes de transmisión y embrague.'],
            ['nombre' => 'Dirección', 'descripcion' => 'Componentes del sistema de dirección.'],
            ['nombre' => 'Electricidad', 'descripcion' => 'Componentes eléctricos y electrónicos.'],
            ['nombre' => 'Refrigeración', 'descripcion' => 'Componentes del sistema de refrigeración.'],
            ['nombre' => 'Filtros', 'descripcion' => 'Filtros de aceite, aire, combustible y otros.'],
            ['nombre' => 'Lubricantes', 'descripcion' => 'Aceites, grasas y lubricantes automotrices.'],
            ['nombre' => 'Carrocería', 'descripcion' => 'Partes externas y estructurales del vehículo.'],
            ['nombre' => 'Escape', 'descripcion' => 'Componentes del sistema de escape.'],
            ['nombre' => 'Accesorios', 'descripcion' => 'Accesorios y complementos automotrices.'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                [
                    'descripcion' => $categoria['descripcion'],
                    'activo' => true,
                ]
            );
        }
    }
}

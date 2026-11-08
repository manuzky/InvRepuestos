<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Database\Seeder;
use Exception;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'codigo' => 'REP-0001',
                'nombre' => 'Bujía de encendido',
                'categoria' => 'Motor',
                'marca' => 'Toyota',
                'descripcion' => 'Bujía de encendido para motores a gasolina.',
                'costo' => 4.50,
                'precio_venta' => 7.00,
                'stock_minimo' => 10,
            ],
            [
                'codigo' => 'REP-0002',
                'nombre' => 'Filtro de aceite',
                'categoria' => 'Filtros',
                'marca' => 'Chevrolet',
                'descripcion' => 'Filtro de aceite para motores automotrices.',
                'costo' => 3.25,
                'precio_venta' => 5.50,
                'stock_minimo' => 10,
            ],
            [
                'codigo' => 'REP-0003',
                'nombre' => 'Pastillas de freno delanteras',
                'categoria' => 'Frenos',
                'marca' => 'Toyota',
                'descripcion' => 'Juego de pastillas de freno delanteras.',
                'costo' => 18.00,
                'precio_venta' => 28.50,
                'stock_minimo' => 5,
            ],
            [
                'codigo' => 'REP-0004',
                'nombre' => 'Amortiguador delantero',
                'categoria' => 'Suspensión',
                'marca' => 'Ford',
                'descripcion' => 'Amortiguador delantero para vehículos livianos.',
                'costo' => 35.00,
                'precio_venta' => 52.00,
                'stock_minimo' => 4,
            ],
            [
                'codigo' => 'REP-0005',
                'nombre' => 'Correa de distribución',
                'categoria' => 'Motor',
                'marca' => 'Hyundai',
                'descripcion' => 'Correa de distribución para motor automotriz.',
                'costo' => 22.50,
                'precio_venta' => 35.00,
                'stock_minimo' => 5,
            ],
            [
                'codigo' => 'REP-0006',
                'nombre' => 'Filtro de aire',
                'categoria' => 'Filtros',
                'marca' => 'Nissan',
                'descripcion' => 'Filtro de aire para motor.',
                'costo' => 6.00,
                'precio_venta' => 9.50,
                'stock_minimo' => 8,
            ],
            [
                'codigo' => 'REP-0007',
                'nombre' => 'Batería automotriz',
                'categoria' => 'Electricidad',
                'marca' => 'Chevrolet',
                'descripcion' => 'Batería para vehículos livianos.',
                'costo' => 75.00,
                'precio_venta' => 105.00,
                'stock_minimo' => 3,
            ],
            [
                'codigo' => 'REP-0008',
                'nombre' => 'Rodamiento de rueda',
                'categoria' => 'Suspensión',
                'marca' => 'Toyota',
                'descripcion' => 'Rodamiento para conjunto de rueda.',
                'costo' => 14.00,
                'precio_venta' => 22.00,
                'stock_minimo' => 5,
            ],
            [
                'codigo' => 'REP-0009',
                'nombre' => 'Bomba de agua',
                'categoria' => 'Refrigeración',
                'marca' => 'Ford',
                'descripcion' => 'Bomba de agua para sistema de refrigeración.',
                'costo' => 28.00,
                'precio_venta' => 42.00,
                'stock_minimo' => 4,
            ],
            [
                'codigo' => 'REP-0010',
                'nombre' => 'Aceite de motor 5W-30',
                'categoria' => 'Lubricantes',
                'marca' => 'Toyota',
                'descripcion' => 'Aceite lubricante sintético para motor.',
                'costo' => 8.50,
                'precio_venta' => 13.00,
                'stock_minimo' => 12,
            ],
            [
                'codigo' => 'REP-0011',
                'nombre' => 'Banda de accesorios',
                'categoria' => 'Motor',
                'marca' => 'Hyundai',
                'descripcion' => 'Banda para accesorios del motor.',
                'costo' => 9.00,
                'precio_venta' => 14.50,
                'stock_minimo' => 5,
            ],
            [
                'codigo' => 'REP-0012',
                'nombre' => 'Bujía de precalentamiento',
                'categoria' => 'Motor',
                'marca' => 'Nissan',
                'descripcion' => 'Bujía de precalentamiento para motores diésel.',
                'costo' => 12.00,
                'precio_venta' => 18.00,
                'stock_minimo' => 5,
            ],
        ];

        foreach ($productos as $datos) {
            $categoria = Categoria::where('nombre', $datos['categoria'])->first();
            $marca = Marca::where('nombre', $datos['marca'])->first();

            if (!$categoria) {
                throw new Exception("No existe la categoría: {$datos['categoria']}");
            }

            if (!$marca) {
                throw new Exception("No existe la marca: {$datos['marca']}");
            }

            Producto::updateOrCreate(
                ['codigo' => $datos['codigo']],
                [
                    'nombre' => $datos['nombre'],
                    'categoria_id' => $categoria->id,
                    'marca_id' => $marca->id,
                    'descripcion' => $datos['descripcion'],
                    'costo' => $datos['costo'],
                    'precio_venta' => $datos['precio_venta'],
                    'stock' => 0,
                    'stock_minimo' => $datos['stock_minimo'],
                    'activo' => true,
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            [
                'nombre' => 'Distribuidora Automotriz del Norte',
                'rif' => 'J-40123456-1',
                'persona_contacto' => 'Carlos Méndez',
                'telefono' => '0414-5551234',
                'email' => 'ventas@norte.test',
                'direccion' => 'Barcelona, Anzoátegui',
            ],
            [
                'nombre' => 'Repuestos El Motor',
                'rif' => 'J-40234567-2',
                'persona_contacto' => 'María González',
                'telefono' => '0412-5552345',
                'email' => 'contacto@elmotor.test',
                'direccion' => 'Puerto La Cruz, Anzoátegui',
            ],
            [
                'nombre' => 'Importadora Vial',
                'rif' => 'J-40345678-3',
                'persona_contacto' => 'José Rodríguez',
                'telefono' => '0416-5553456',
                'email' => 'ventas@vial.test',
                'direccion' => 'Lechería, Anzoátegui',
            ],
            [
                'nombre' => 'Suministros Automotrices Oriente',
                'rif' => 'J-40456789-4',
                'persona_contacto' => 'Ana Pérez',
                'telefono' => '0424-5554567',
                'email' => 'info@oriente.test',
                'direccion' => 'Anaco, Anzoátegui',
            ],
            [
                'nombre' => 'Comercializadora Los Pinos',
                'rif' => 'J-40567890-5',
                'persona_contacto' => 'Luis Herrera',
                'telefono' => '0414-5555678',
                'email' => 'compras@lospinos.test',
                'direccion' => 'El Tigre, Anzoátegui',
            ],
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::updateOrCreate(
                ['rif' => $proveedor['rif']],
                array_merge($proveedor, ['activo' => true])
            );
        }
    }
}

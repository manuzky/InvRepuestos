<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nombre' => 'Carlos Mendoza',
                'documento' => 'V-12345678',
                'telefono' => '0414-5551234',
                'email' => 'carlos.mendoza@example.com',
                'direccion' => 'Barcelona, Anzoátegui',
            ],
            [
                'nombre' => 'María Rodríguez',
                'documento' => 'V-23456789',
                'telefono' => '0412-5552345',
                'email' => 'maria.rodriguez@example.com',
                'direccion' => 'Puerto La Cruz, Anzoátegui',
            ],
            [
                'nombre' => 'José Hernández',
                'documento' => 'V-34567890',
                'telefono' => '0416-5553456',
                'email' => 'jose.hernandez@example.com',
                'direccion' => 'Lechería, Anzoátegui',
            ],
            [
                'nombre' => 'Ana Pérez',
                'documento' => 'V-45678901',
                'telefono' => '0424-5554567',
                'email' => 'ana.perez@example.com',
                'direccion' => 'Anaco, Anzoátegui',
            ],
            [
                'nombre' => 'Luis González',
                'documento' => 'V-56789012',
                'telefono' => '0414-5555678',
                'email' => 'luis.gonzalez@example.com',
                'direccion' => 'El Tigre, Anzoátegui',
            ],
            [
                'nombre' => 'Repuestos El Oriente, C.A.',
                'documento' => 'J-40123456-1',
                'telefono' => '0281-5551234',
                'email' => 'contacto@repuestosoriente.test',
                'direccion' => 'Av. Intercomunal, Barcelona, Anzoátegui',
            ],
            [
                'nombre' => 'Autopartes del Caribe, C.A.',
                'documento' => 'J-40234567-2',
                'telefono' => '0281-5552345',
                'email' => 'ventas@autopartescaribe.test',
                'direccion' => 'Puerto La Cruz, Anzoátegui',
            ],
            [
                'nombre' => 'Transporte y Servicios Viales, C.A.',
                'documento' => 'J-40345678-3',
                'telefono' => '0281-5553456',
                'email' => 'administracion@serviciosviales.test',
                'direccion' => 'Lechería, Anzoátegui',
            ],
            [
                'nombre' => 'Comercializadora San José, C.A.',
                'documento' => 'J-40456789-4',
                'telefono' => '0282-5554567',
                'email' => 'compras@sanjose.test',
                'direccion' => 'El Tigre, Anzoátegui',
            ],
            [
                'nombre' => 'Taller Mecánico Los Amigos, C.A.',
                'documento' => 'J-40567890-5',
                'telefono' => '0414-5556789',
                'email' => 'taller@losamigos.test',
                'direccion' => 'Barcelona, Anzoátegui',
            ],
        ];

        foreach ($clientes as $datos) {
            Cliente::updateOrCreate(
                ['documento' => $datos['documento']],
                [
                    'nombre' => $datos['nombre'],
                    'telefono' => $datos['telefono'],
                    'email' => $datos['email'],
                    'direccion' => $datos['direccion'],
                    'activo' => true,
                ]
            );
        }
    }
}

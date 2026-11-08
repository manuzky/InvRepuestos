<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cargo;

class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        $cargo = Cargo::firstOrCreate([
            'nombre' => 'Administrador',
        ]);

        $usuario = User::updateOrCreate(
            ['cedula' => '00000000'],
            [
                'cargo_id' => $cargo->id,
                'name' => 'Administrador',
                'apellidos' => 'Sistema',
                'cedula' => '00000000',
                'email' => 'admin@gmail.com',
                'password' => '123456789',
                'activo' => true,
            ]
        );

        $usuario->syncRoles(['Administrador']);
    }
}

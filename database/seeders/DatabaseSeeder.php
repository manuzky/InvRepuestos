<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CargosSeeder::class,
            RolesYPermisosSeeder::class,
            AdministradorSeeder::class,

            CategoriasSeeder::class,
            MarcasSeeder::class,
            ProveedoresSeeder::class,
        ]);
    }
}
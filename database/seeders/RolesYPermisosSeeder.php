<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permisos = [
            // Usuarios
            'usuarios.view',
            'usuarios.create',
            'usuarios.edit',
            'usuarios.delete',

            // Cargos
            'cargos.view',
            'cargos.create',
            'cargos.edit',
            'cargos.delete',

            // Roles y permisos
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Categorías
            'categorias.view',
            'categorias.create',
            'categorias.edit',
            'categorias.delete',

            // Marcas
            'marcas.view',
            'marcas.create',
            'marcas.edit',
            'marcas.delete',

            // Productos
            'productos.view',
            'productos.create',
            'productos.edit',
            'productos.delete',

            // Proveedores
            'proveedores.view',
            'proveedores.create',
            'proveedores.edit',
            'proveedores.delete',

            // Clientes
            'clientes.view',
            'clientes.create',
            'clientes.edit',
            'clientes.delete',

            // Entradas
            'entradas.view',
            'entradas.create',
            'entradas.cancel',

            // Ventas
            'ventas.view',
            'ventas.create',
            'ventas.cancel',

            // Reportes
            'reportes.view',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'guard_name' => 'web',
            ]);
        }

        // Roles iniciales
        $administrador = Role::firstOrCreate([
            'name' => 'Administrador',
            'guard_name' => 'web',
        ]);

        $vendedor = Role::firstOrCreate([
            'name' => 'Vendedor',
            'guard_name' => 'web',
        ]);

        $almacen = Role::firstOrCreate([
            'name' => 'Almacén',
            'guard_name' => 'web',
        ]);

        $supervisor = Role::firstOrCreate([
            'name' => 'Supervisor',
            'guard_name' => 'web',
        ]);

        // Administrador: todos los permisos
        $administrador->syncPermissions(
            Permission::all()
        );

        // Vendedor
        $vendedor->syncPermissions([
            'clientes.view',
            'clientes.create',
            'clientes.edit',
            'ventas.view',
            'ventas.create',
        ]);

        // Almacén
        $almacen->syncPermissions([
            'productos.view',
            'productos.create',
            'productos.edit',
            'categorias.view',
            'marcas.view',
            'proveedores.view',
            'entradas.view',
            'entradas.create',
        ]);

        // Supervisor: consulta de operaciones y reportes
        $supervisor->syncPermissions([
            'usuarios.view',
            'productos.view',
            'categorias.view',
            'marcas.view',
            'proveedores.view',
            'clientes.view',
            'entradas.view',
            'ventas.view',
            'reportes.view',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
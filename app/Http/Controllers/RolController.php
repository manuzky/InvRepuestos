<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:roles.view', only: ['index']),
            new Middleware('can:roles.create', only: ['create', 'store']),
            new Middleware('can:roles.edit', only: ['edit', 'update']),
            new Middleware('can:roles.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::where('guard_name', 'web')
            ->with('permissions')
            ->orderBy('name')
            ->get()
            ->map(function ($rol) {
                $rol->usuarios_count = User::role($rol->name)->count();
                return $rol;
            });

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permisos = $this->obtenerPermisos();

        return view('roles.create', compact('permisos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['required', 'exists:permissions,name'],
        ]);

        $rol = Role::create([
            'name' => $datos['name'],
            'guard_name' => 'web',
        ]);

        $rol->syncPermissions($datos['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    public function edit(Role $role)
    {
        abort_unless($role->guard_name === 'web', 404);

        $rol = $role;

        $permisos = $this->obtenerPermisos();
        $permisosSeleccionados = $rol->permissions->pluck('name')->all();

        return view('roles.edit', compact(
            'rol',
            'permisos',
            'permisosSeleccionados'
        ));
    }

    public function update(Request $request, Role $role)
    {
        abort_unless($role->guard_name === 'web', 404);

        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('roles', 'name')
                    ->where('guard_name', 'web')
                    ->ignore($role->id),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['required', 'exists:permissions,name'],
        ]);

        $role->update([
            'name' => $datos['name'],
        ]);

        $role->syncPermissions($datos['permissions'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(Role $role)
    {
        abort_unless($role->guard_name === 'web', 404);

        if ($role->name === 'Administrador') {
            return back()->with('error', 'No puedes eliminar el rol Administrador.');
        }

        if (User::role($role->name)->exists()) {
            return back()->with('error', 'No puedes eliminar un rol que está asignado a usuarios.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }

    private function obtenerPermisos()
    {
        return Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get()
            ->groupBy(fn ($permiso) => ucfirst(strtok($permiso->name, '.')));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UsuarioController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:usuarios.view', only: ['index']),
            new Middleware('can:usuarios.create', only: ['create', 'store']),
            new Middleware('can:usuarios.edit', only: ['edit', 'update', 'toggleStatus']),
        ];
    }

    public function index()
    {
        $usuarios = User::with(['cargo', 'roles'])
            ->latest()
            ->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $cargos = Cargo::where('activo', true)
            ->orderBy('nombre')
            ->get();

        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('usuarios.create', compact('cargos', 'roles'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedula' => ['required', 'string', 'max:20', 'unique:users,cedula'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string'],
            'cargo_id' => ['nullable', 'exists:cargos,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', 'exists:roles,name'],
        ]);

        $roles = $datos['roles'];
        unset($datos['roles']);

        $datos['activo'] = true;

        $usuario = User::create($datos);
        $usuario->syncRoles($roles);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }

    public function edit(User $usuario)
    {
        $usuario->load('roles');

        $cargos = Cargo::where('activo', true)
            ->orWhere('id', $usuario->cargo_id)
            ->orderBy('nombre')
            ->get();

        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('usuarios.edit', compact('usuario', 'cargos', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedula' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'cedula')->ignore($usuario->id),
            ],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],
            'telefono' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string'],
            'cargo_id' => ['nullable', 'exists:cargos,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['required', 'exists:roles,name'],
        ]);

        $roles = $datos['roles'];
        unset($datos['roles']);

        if (empty($datos['password'])) {
            unset($datos['password']);
        }

        $usuario->update($datos);
        $usuario->syncRoles($roles);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function toggleStatus(User $usuario)
    {
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No puedes desactivar tu propio usuario.');
        }

        $usuario->update([
            'activo' => !$usuario->activo,
        ]);

        return back()->with(
            'success',
            $usuario->activo ? 'Usuario activado correctamente.' : 'Usuario desactivado correctamente.'
        );
    }
}

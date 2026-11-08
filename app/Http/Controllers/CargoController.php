<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CargoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:cargos.view', only: ['index']),
            new Middleware('can:cargos.create', only: ['create', 'store']),
            new Middleware('can:cargos.edit', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('can:cargos.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $cargos = Cargo::withCount('usuarios')
            ->latest()
            ->paginate(10);

        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:cargos,nombre'],
            'descripcion' => ['nullable', 'string'],
        ]);

        Cargo::create($datos);

        return redirect()->route('cargos.index')->with('success', 'Cargo creado correctamente.');
    }

    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:cargos,nombre,' . $cargo->id],
            'descripcion' => ['nullable', 'string'],
        ]);

        $cargo->update($datos);

        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado correctamente.');
    }

    public function toggleStatus(Cargo $cargo)
    {
        $cargo->update([
            'activo' => !$cargo->activo,
        ]);

        return back()->with('success', 'Estado del cargo actualizado correctamente.');
    }

    public function destroy(Cargo $cargo)
    {
        if ($cargo->usuarios()->exists()) {
            return back()->with('error', 'No puedes eliminar un cargo que tiene empleados asignados.');
        }

        $cargo->delete();

        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado correctamente.');
    }
}

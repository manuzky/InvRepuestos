<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProveedorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:proveedores.view', only: ['index']),
            new Middleware('can:proveedores.create', only: ['create', 'store']),
            new Middleware('can:proveedores.edit', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('can:proveedores.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre')->paginate(10);

        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'rif' => ['nullable', 'string', 'max:20', 'unique:proveedores,rif'],
            'persona_contacto' => ['nullable', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'direccion' => ['nullable', 'string'],
        ]);

        Proveedor::create($datos);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'rif' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('proveedores', 'rif')->ignore($proveedor->id),
            ],
            'persona_contacto' => ['nullable', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'direccion' => ['nullable', 'string'],
        ]);

        $proveedor->update($datos);

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function toggleStatus(Proveedor $proveedor)
    {
        $proveedor->update([
            'activo' => !$proveedor->activo,
        ]);

        return back()->with('success', 'Estado del proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}

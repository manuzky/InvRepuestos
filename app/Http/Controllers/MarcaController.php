<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MarcaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:marcas.view', only: ['index']),
            new Middleware('can:marcas.create', only: ['create', 'store']),
            new Middleware('can:marcas.edit', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('can:marcas.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $marcas = Marca::orderBy('nombre')->paginate(10);

        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:marcas,nombre'],
            'descripcion' => ['nullable', 'string'],
        ]);

        Marca::create($datos);

        return redirect()->route('marcas.index')->with('success', 'Marca registrada correctamente.');
    }

    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('marcas', 'nombre')->ignore($marca->id),
            ],
            'descripcion' => ['nullable', 'string'],
        ]);

        $marca->update($datos);

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente.');
    }

    public function toggleStatus(Marca $marca)
    {
        $marca->update([
            'activo' => !$marca->activo,
        ]);

        return back()->with('success', 'Estado de la marca actualizado correctamente.');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca eliminada correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoriaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:categorias.view', only: ['index']),
            new Middleware('can:categorias.create', only: ['create', 'store']),
            new Middleware('can:categorias.edit', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('can:categorias.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $categorias = Categoria::orderBy('nombre')->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:categorias,nombre'],
            'descripcion' => ['nullable', 'string'],
        ]);

        Categoria::create($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categorias', 'nombre')->ignore($categoria->id),
            ],
            'descripcion' => ['nullable', 'string'],
        ]);

        $categoria->update($datos);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function toggleStatus(Categoria $categoria)
    {
        $categoria->update([
            'activo' => !$categoria->activo,
        ]);

        return back()->with('success', 'Estado de la categoría actualizado correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}

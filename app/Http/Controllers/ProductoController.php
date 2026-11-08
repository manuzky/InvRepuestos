<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:productos.view', only: ['index']),
            new Middleware('can:productos.create', only: ['create', 'store']),
            new Middleware('can:productos.edit', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('can:productos.delete', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $productos = Producto::with(['categoria', 'marca'])
            ->when($request->buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('codigo', 'like', "%{$buscar}%")
                        ->orWhere('nombre', 'like', "%{$buscar}%")
                        ->orWhereHas('marca', fn ($q) => $q->where('nombre', 'like', "%{$buscar}%"))
                        ->orWhereHas('categoria', fn ($q) => $q->where('nombre', 'like', "%{$buscar}%"));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', true)->orderBy('nombre')->get();
        $marcas = Marca::where('activo', true)->orderBy('nombre')->get();

        return view('productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:50', 'unique:productos,codigo'],
            'nombre' => ['required', 'string', 'max:150'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'marca_id' => ['required', 'exists:marcas,id'],
            'descripcion' => ['nullable', 'string'],
            'costo' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'precio_venta' => ['required', 'numeric', 'min:0.01', 'decimal:0,2'],
            'stock_minimo' => ['required', 'integer', 'min:0'],
        ]);

        $datos['stock'] = 0;
        $datos['activo'] = true;

        Producto::create($datos);

        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('activo', true)
            ->orWhere('id', $producto->categoria_id)
            ->orderBy('nombre')
            ->get();

        $marcas = Marca::where('activo', true)
            ->orWhere('id', $producto->marca_id)
            ->orderBy('nombre')
            ->get();

        return view('productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, Producto $producto)
    {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('productos', 'codigo')->ignore($producto->id),
            ],
            'nombre' => ['required', 'string', 'max:150'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'marca_id' => ['required', 'exists:marcas,id'],
            'descripcion' => ['nullable', 'string'],
            'costo' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'precio_venta' => ['required', 'numeric', 'min:0.01', 'decimal:0,2'],
            'stock_minimo' => ['required', 'integer', 'min:0'],
        ]);

        $producto->update($datos);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function toggleStatus(Producto $producto)
    {
        $producto->update([
            'activo' => !$producto->activo,
        ]);

        return back()->with(
            'success',
            'Estado del producto actualizado correctamente.'
        );
    }

    public function destroy(Producto $producto)
    {
        if ($producto->stock > 0) {
            return back()->with('error', 'No puedes eliminar un producto que tiene existencias.');
        }

        $producto->delete();

        return back()->with('success', 'Producto eliminado correctamente.');
    }
}

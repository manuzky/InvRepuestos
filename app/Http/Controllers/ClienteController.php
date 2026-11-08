<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ClienteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:clientes.view', only: ['index']),
            new Middleware('can:clientes.create', only: ['create', 'store']),
            new Middleware('can:clientes.edit', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('can:clientes.delete', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $clientes = Cliente::query()
            ->when($request->buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('documento', 'like', "%{$buscar}%")
                        ->orWhere('telefono', 'like', "%{$buscar}%")
                        ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'documento' => ['nullable', 'string', 'max:20', 'unique:clientes,documento'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150', 'unique:clientes,email'],
            'direccion' => ['nullable', 'string'],
        ]);

        $datos['activo'] = true;

        Cliente::create($datos);

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'documento' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('clientes', 'documento')->ignore($cliente->id),
            ],
            'telefono' => ['nullable', 'string', 'max:30'],
            'email' => [
                'nullable',
                'email',
                'max:150',
                Rule::unique('clientes', 'email')->ignore($cliente->id),
            ],
            'direccion' => ['nullable', 'string'],
        ]);

        $cliente->update($datos);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function toggleStatus(Cliente $cliente)
    {
        $cliente->update([
            'activo' => !$cliente->activo,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Estado del cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
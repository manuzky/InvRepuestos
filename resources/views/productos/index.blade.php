@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Productos</h4>
        <p class="text-muted mb-0">Administra los repuestos del inventario.</p>
    </div>

    @can('productos.create')
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nuevo producto
        </a>
    @endcan
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('productos.index') }}" method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="buscar" class="form-control"
                        placeholder="Buscar por código, nombre, marca o categoría..."
                        value="{{ request('buscar') }}">
                </div>

                <div class="col-auto">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i> Buscar
                    </button>

                    <a href="{{ route('productos.index') }}" class="btn btn-light">
                        Limpiar
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Costo</th>
                        <th>Precio venta</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td class="fw-semibold">{{ $producto->codigo }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->categoria->nombre }}</td>
                            <td>{{ $producto->marca->nombre }}</td>
                            <td>${{ number_format($producto->costo, 2) }}</td>
                            <td>${{ number_format($producto->precio_venta, 2) }}</td>
                            <td>
                                <span class="badge {{ $producto->stock <= $producto->stock_minimo ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ $producto->stock }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $producto->activo ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                @can('productos.edit')
                                    <a href="{{ route('productos.edit', $producto) }}"
                                        class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('productos.toggle-status', $producto) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-{{ $producto->activo ? 'warning' : 'success' }}"
                                            title="{{ $producto->activo ? 'Desactivar' : 'Activar' }}">
                                            <i class="bi bi-{{ $producto->activo ? 'power' : 'check-circle' }}"></i>
                                        </button>
                                    </form>
                                @endcan

                                @can('productos.delete')
                                    <form action="{{ route('productos.destroy', $producto) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                No hay productos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $productos->links() }}
        </div>
    </div>
</div>
@endsection

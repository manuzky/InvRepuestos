@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Categorías</h4>
        <p class="text-muted mb-0">Administra las categorías de los repuestos.</p>
    </div>

    @can('categorias.create')
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva categoría
        </a>
    @endcan
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td class="fw-semibold">{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion ?: '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $categoria->activo ? 'success' : 'secondary' }}">
                                    {{ $categoria->activo ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="text-end">
                                @can('categorias.edit')
                                    <a href="{{ route('categorias.edit', $categoria) }}"
                                       class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('categorias.toggle-status', $categoria) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-{{ $categoria->activo ? 'warning' : 'success' }}"
                                                title="{{ $categoria->activo ? 'Desactivar' : 'Activar' }}">
                                            <i class="bi bi-{{ $categoria->activo ? 'pause' : 'check-lg' }}"></i>
                                        </button>
                                    </form>
                                @endcan

                                @can('categorias.delete')
                                    <form action="{{ route('categorias.destroy', $categoria) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categorias->links() }}
    </div>
</div>
@endsection

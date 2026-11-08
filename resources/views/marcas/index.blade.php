@extends('layouts.app')

@section('title', 'Marcas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Marcas</h4>
        <p class="text-muted mb-0">Administra los fabricantes de los repuestos.</p>
    </div>

    @can('marcas.create')
        <a href="{{ route('marcas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva marca
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
                    @forelse($marcas as $marca)
                        <tr>
                            <td class="fw-semibold">{{ $marca->nombre }}</td>
                            <td>{{ $marca->descripcion ?: '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $marca->activo ? 'success' : 'secondary' }}">
                                    {{ $marca->activo ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="text-end">
                                @can('marcas.edit')
                                    <a href="{{ route('marcas.edit', $marca) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('marcas.toggle-status', $marca) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-{{ $marca->activo ? 'warning' : 'success' }}">
                                            <i class="bi bi-{{ $marca->activo ? 'pause' : 'check-lg' }}"></i>
                                        </button>
                                    </form>
                                @endcan

                                @can('marcas.delete')
                                    <form action="{{ route('marcas.destroy', $marca) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Eliminar esta marca?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                No hay marcas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $marcas->links() }}
    </div>
</div>
@endsection

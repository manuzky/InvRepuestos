@extends('layouts.app')

@section('title', 'Proveedores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Proveedores</h4>
        <p class="text-muted mb-0">Administra los proveedores de repuestos.</p>
    </div>

    @can('proveedores.create')
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nuevo proveedor
        </a>
    @endcan
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>RIF</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proveedores as $proveedor)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $proveedor->nombre }}</div>
                                <small class="text-muted">{{ $proveedor->email ?: 'Sin correo' }}</small>
                            </td>
                            <td>{{ $proveedor->rif ?: '—' }}</td>
                            <td>{{ $proveedor->persona_contacto ?: '—' }}</td>
                            <td>{{ $proveedor->telefono ?: '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $proveedor->activo ? 'success' : 'secondary' }}">
                                    {{ $proveedor->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-end">
                                @can('proveedores.edit')
                                    <a href="{{ route('proveedores.edit', $proveedor) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('proveedores.toggle-status', $proveedor) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-{{ $proveedor->activo ? 'warning' : 'success' }}">
                                            <i class="bi bi-{{ $proveedor->activo ? 'pause' : 'check-lg' }}"></i>
                                        </button>
                                    </form>
                                @endcan

                                @can('proveedores.delete')
                                    <form action="{{ route('proveedores.destroy', $proveedor) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Eliminar este proveedor?')">
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
                            <td colspan="6" class="text-center text-muted py-4">
                                No hay proveedores registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $proveedores->links() }}
    </div>
</div>
@endsection

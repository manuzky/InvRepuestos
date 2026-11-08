@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Clientes</h4>
            <p class="text-muted mb-0">Gestiona los clientes del negocio.</p>
        </div>

        @can('clientes.create')
            <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Nuevo cliente
            </a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('clientes.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input
                        type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar por nombre, documento, teléfono o correo..."
                        value="{{ request('buscar') }}"
                    >
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>

                    @if(request('buscar'))
                        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                            Limpiar
                        </a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Cliente</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <td class="fw-semibold">{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->documento ?? '—' }}</td>
                                <td>{{ $cliente->telefono ?? '—' }}</td>
                                <td>{{ $cliente->email ?? '—' }}</td>
                                <td>
                                    @if($cliente->activo)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @can('clientes.edit')
                                        <a href="{{ route('clientes.edit', $cliente) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('clientes.toggle-status', $cliente) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-{{ $cliente->activo ? 'warning' : 'success' }}"
                                                    title="{{ $cliente->activo ? 'Desactivar' : 'Activar' }}">
                                                <i class="bi bi-{{ $cliente->activo ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                    @endcan

                                    @can('clientes.delete')
                                        <form action="{{ route('clientes.destroy', $cliente) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No se encontraron clientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Mostrando {{ $clientes->firstItem() ?? 0 }} a {{ $clientes->lastItem() ?? 0 }}
                    de {{ $clientes->total() }} clientes
                </small>

                {{ $clientes->links() }}
            </div>

        </div>
    </div>
</div>
@endsection

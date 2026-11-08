@extends('layouts.app')

@section('title', 'Cargos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Cargos</h3>
            <p class="text-muted mb-0">Administración de cargos de los empleados.</p>
        </div>

        @can('cargos.create')
            <a href="{{ route('cargos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Nuevo cargo
            </a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Cargo</th>
                            <th>Descripción</th>
                            <th>Empleados</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cargos as $cargo)
                            <tr>
                                <td class="fw-semibold">{{ $cargo->nombre }}</td>
                                <td>{{ $cargo->descripcion ?: '—' }}</td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $cargo->usuarios_count }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $cargo->activo ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $cargo->activo ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    @can('cargos.edit')
                                        <a href="{{ route('cargos.edit', $cargo) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('cargos.toggle-status', $cargo) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Cambiar el estado de este cargo?')">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-power"></i>
                                            </button>
                                        </form>
                                    @endcan

                                    @can('cargos.delete')
                                        <form action="{{ route('cargos.destroy', $cargo) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Eliminar este cargo?')">
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    No hay cargos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $cargos->links() }}
        </div>
    </div>
@endsection

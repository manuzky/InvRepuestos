@extends('layouts.app')

@section('title', 'Roles y permisos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Roles y permisos</h3>
            <p class="text-muted mb-0">Controla los accesos de los usuarios al sistema.</p>
        </div>

        @can('roles.create')
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Nuevo rol
            </a>
        @endcan
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Permisos</th>
                            <th>Usuarios asignados</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($roles as $rol)
                            <tr>
                                <td class="fw-semibold">
                                    <i class="bi bi-shield-check text-primary me-2"></i>
                                    {{ $rol->name }}
                                </td>

                                <td>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $rol->permissions->count() }} permisos
                                    </span>
                                </td>

                                <td>{{ $rol->usuarios_count }}</td>

                                <td class="text-end">
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', ['role' => $rol->id]) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    @endcan

                                    @can('roles.delete')
                                        @if ($rol->name !== 'Administrador')
                                            <form action="{{ route('roles.destroy', ['role' => $rol->id]) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Eliminar este rol?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No hay roles registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

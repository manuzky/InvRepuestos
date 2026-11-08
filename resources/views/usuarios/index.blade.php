@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Usuarios y empleados</h3>
            <p class="text-muted mb-0">Administración de usuarios del sistema.</p>
        </div>

        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            + Nuevo usuario
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Cédula</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Roles</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }} {{ $usuario->apellidos }}</td>
                                <td>{{ $usuario->cedula }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->cargo?->nombre ?? 'Sin cargo' }}</td>
                                <td>{{ $usuario->getRoleNames()->implode(', ') ?: 'Sin roles' }}</td>
                                <td>
                                    <span class="badge {{ $usuario->activo ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('usuarios.edit', $usuario) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Editar
                                    </a>

                                    @if ($usuario->id !== Auth::id())
                                        <form action="{{ route('usuarios.toggle-status', $usuario) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Deseas cambiar el estado de este usuario?')">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-sm {{ $usuario->activo ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                {{ $usuario->activo ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No hay usuarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $usuarios->links() }}
        </div>
    </div>
@endsection

@php
    $esEdicion = isset($usuario);
    $rolesSeleccionados = old('roles', $esEdicion ? $usuario->getRoleNames()->all() : []);
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Revisa los siguientes errores:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Información personal</div>

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombres *</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $usuario->name ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Apellidos *</label>
                <input type="text" name="apellidos" class="form-control"
                       value="{{ old('apellidos', $usuario->apellidos ?? '') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Cédula *</label>
                <input type="text" name="cedula" class="form-control"
                       value="{{ old('cedula', $usuario->cedula ?? '') }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control"
                       value="{{ old('telefono', $usuario->telefono ?? '') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Cargo</label>
                <select name="cargo_id" class="form-select">
                    <option value="">Sin cargo</option>
                    @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->id }}"
                            @selected(old('cargo_id', $usuario->cargo_id ?? '') == $cargo->id)>
                            {{ $cargo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Correo electrónico *</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $usuario->email ?? '') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control"
                       value="{{ old('direccion', $usuario->direccion ?? '') }}">
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-header bg-white fw-semibold">Acceso al sistema</div>

    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">
                    Contraseña {{ $esEdicion ? '' : '*' }}
                </label>
                <input type="password" name="password" class="form-control"
                       {{ $esEdicion ? '' : 'required' }}>
                @if ($esEdicion)
                    <small class="text-muted">Déjala vacía si no deseas cambiarla.</small>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">
                    Confirmar contraseña {{ $esEdicion ? '' : '*' }}
                </label>
                <input type="password" name="password_confirmation" class="form-control"
                       {{ $esEdicion ? '' : 'required' }}>
            </div>
        </div>

        <hr>

        <label class="form-label fw-semibold">Roles *</label>

        <div class="row">
            @foreach ($roles as $role)
                <div class="col-md-3 mb-2">
                    <div class="form-check">
                        <input type="checkbox" name="roles[]"
                               value="{{ $role->name }}"
                               id="rol_{{ $role->id }}"
                               class="form-check-input"
                               @checked(in_array($role->name, $rolesSeleccionados))>

                        <label class="form-check-label" for="rol_{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

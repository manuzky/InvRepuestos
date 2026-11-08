@php
    $esEdicion = isset($rol);
    $seleccionados = old(
        'permissions',
        $esEdicion ? $permisosSeleccionados : []
    );
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <label class="form-label">Nombre del rol *</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name', $rol->name ?? '') }}"
               maxlength="100"
               required
               placeholder="Ejemplo: Vendedor">
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="fw-bold mb-1">Permisos del sistema</h5>
        <p class="text-muted small mb-0">Selecciona las acciones que podrá realizar este rol.</p>
    </div>

    <button type="button" class="btn btn-sm btn-outline-primary" id="seleccionarTodos">
        Seleccionar todos
    </button>
</div>

<div class="row g-3">
    @foreach ($permisos as $modulo => $lista)
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <strong>{{ $modulo }}</strong>

                    <div class="form-check">
                        <input type="checkbox"
                               class="form-check-input seleccionar-modulo"
                               data-modulo="{{ $loop->index }}">
                    </div>
                </div>

                <div class="card-body">
                    @foreach ($lista as $permiso)
                        @php
                            $partes = explode('.', $permiso->name);
                            $accion = $partes[1] ?? $permiso->name;

                            $nombres = [
                                'view' => 'Consultar',
                                'create' => 'Crear',
                                'edit' => 'Editar',
                                'delete' => 'Eliminar',
                                'cancel' => 'Anular',
                            ];
                        @endphp

                        <div class="form-check mb-2">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permiso->name }}"
                                   class="form-check-input permiso-checkbox modulo-{{ $loop->parent->index }}"
                                   id="permiso_{{ $permiso->id }}"
                                   @checked(in_array($permiso->name, $seleccionados))>

                            <label class="form-check-label"
                                   for="permiso_{{ $permiso->id }}">
                                {{ $nombres[$accion] ?? ucfirst($accion) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    document.querySelectorAll('.seleccionar-modulo').forEach(check => {
        check.addEventListener('change', function () {
            document.querySelectorAll('.modulo-' + this.dataset.modulo)
                .forEach(permiso => permiso.checked = this.checked);
        });
    });

    document.getElementById('seleccionarTodos').addEventListener('click', function () {
        const permisos = document.querySelectorAll('.permiso-checkbox');
        const seleccionar = [...permisos].some(permiso => !permiso.checked);

        permisos.forEach(permiso => permiso.checked = seleccionar);
        document.querySelectorAll('.seleccionar-modulo')
            .forEach(check => check.checked = seleccionar);
    });
</script>
@endpush

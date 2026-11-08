<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Información del cliente</h5>
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nombre o razón social <span class="text-danger">*</span></label>
                <input
                    type="text"
                    name="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $cliente->nombre ?? '') }}"
                    placeholder="Nombre completo o empresa"
                    required
                    maxlength="150"
                >
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Cédula o RIF</label>
                <input
                    type="text"
                    name="documento"
                    class="form-control @error('documento') is-invalid @enderror"
                    value="{{ old('documento', $cliente->documento ?? '') }}"
                    placeholder="Ej. V-12345678 o J-12345678-9"
                    maxlength="20"
                >
                @error('documento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input
                    type="text"
                    name="telefono"
                    class="form-control @error('telefono') is-invalid @enderror"
                    value="{{ old('telefono', $cliente->telefono ?? '') }}"
                    placeholder="Ej. 0414-1234567"
                    maxlength="30"
                >
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $cliente->email ?? '') }}"
                    placeholder="correo@ejemplo.com"
                    maxlength="150"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Dirección</label>
                <textarea
                    name="direccion"
                    rows="3"
                    class="form-control @error('direccion') is-invalid @enderror"
                    placeholder="Dirección del cliente"
                >{{ old('direccion', $cliente->direccion ?? '') }}</textarea>
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('clientes.index') }}" class="btn btn-light border">
        Cancelar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i>
        {{ isset($cliente) ? 'Guardar cambios' : 'Registrar cliente' }}
    </button>
</div>

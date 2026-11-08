<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label">Nombre o razón social <span class="text-danger">*</span></label>
                <input type="text" name="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $proveedor->nombre ?? '') }}"
                       maxlength="150" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">RIF</label>
                <input type="text" name="rif"
                       class="form-control @error('rif') is-invalid @enderror"
                       value="{{ old('rif', $proveedor->rif ?? '') }}"
                       maxlength="20">
                @error('rif')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Persona de contacto</label>
                <input type="text" name="persona_contacto"
                       class="form-control @error('persona_contacto') is-invalid @enderror"
                       value="{{ old('persona_contacto', $proveedor->persona_contacto ?? '') }}"
                       maxlength="150">
                @error('persona_contacto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono"
                       class="form-control @error('telefono') is-invalid @enderror"
                       value="{{ old('telefono', $proveedor->telefono ?? '') }}"
                       maxlength="30">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $proveedor->email ?? '') }}"
                       maxlength="150">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Dirección</label>
                <textarea name="direccion" rows="3"
                          class="form-control @error('direccion') is-invalid @enderror">{{ old('direccion', $proveedor->direccion ?? '') }}</textarea>
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('proveedores.index') }}" class="btn btn-light">Cancelar</a>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i>
        {{ isset($proveedor) ? 'Guardar cambios' : 'Registrar proveedor' }}
    </button>
</div>

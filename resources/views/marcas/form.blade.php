<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="mb-3">
            <label for="nombre" class="form-label">
                Nombre <span class="text-danger">*</span>
            </label>
            <input type="text" name="nombre" id="nombre"
                   class="form-control @error('nombre') is-invalid @enderror"
                   value="{{ old('nombre', $marca->nombre ?? '') }}"
                   maxlength="100" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3"
                      class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $marca->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('marcas.index') }}" class="btn btn-light">Cancelar</a>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-lg me-1"></i>
        {{ isset($marca) ? 'Guardar cambios' : 'Registrar marca' }}
    </button>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Nombre del cargo *</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ old('nombre', $cargo->nombre ?? '') }}"
                   maxlength="100" required>
        </div>

        <div>
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $cargo->descripcion ?? '') }}</textarea>
        </div>
    </div>
</div>

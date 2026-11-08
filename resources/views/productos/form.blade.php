
@csrf

<div class="row g-3">

    {{-- Información del producto --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-2">
                        <i class="bi bi-box-seam fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Información del producto</h6>
                        <small class="text-muted">Datos generales e identificación del repuesto.</small>
                    </div>
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Código <span class="text-danger">*</span></label>
                        <input type="text" name="codigo"
                            class="form-control @error('codigo') is-invalid @enderror"
                            value="{{ old('codigo', $producto->codigo ?? '') }}"
                            placeholder="Ej. REP-0001" maxlength="50" required>
                        @error('codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-medium">Nombre del producto <span class="text-danger">*</span></label>
                        <input type="text" name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $producto->nombre ?? '') }}"
                            placeholder="Nombre del repuesto" maxlength="150" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Categoría <span class="text-danger">*</span></label>
                        <select name="categoria_id"
                            class="form-select @error('categoria_id') is-invalid @enderror" required>
                            <option value="">Seleccionar categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    @selected(old('categoria_id', $producto->categoria_id ?? '') == $categoria->id)>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Marca <span class="text-danger">*</span></label>
                        <select name="marca_id"
                            class="form-select @error('marca_id') is-invalid @enderror" required>
                            <option value="">Seleccionar marca</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}"
                                    @selected(old('marca_id', $producto->marca_id ?? '') == $marca->id)>
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('marca_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium">Descripción</label>
                        <textarea name="descripcion" rows="5"
                            class="form-control @error('descripcion') is-invalid @enderror"
                            placeholder="Agrega detalles, características o especificaciones del repuesto...">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Información comercial --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 bg-success bg-opacity-10 text-success p-2">
                        <i class="bi bi-currency-dollar fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Información comercial</h6>
                        <small class="text-muted">Costos y precios de venta en dólares.</small>
                    </div>
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                <div class="mb-4">
                    <label class="form-label fw-medium">Costo de compra <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-semibold">$</span>
                        <input type="number" name="costo" step="0.01" min="0"
                            class="form-control @error('costo') is-invalid @enderror"
                            value="{{ old('costo', $producto->costo ?? '0.00') }}"
                            placeholder="0.00" required>
                        @error('costo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Precio de venta <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-semibold">$</span>
                        <input type="number" name="precio_venta" step="0.01" min="0.01"
                            class="form-control @error('precio_venta') is-invalid @enderror"
                            value="{{ old('precio_venta', $producto->precio_venta ?? '') }}"
                            placeholder="0.00" required>
                        @error('precio_venta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="alert alert-light border mb-0">
                    <div class="d-flex gap-2">
                        <i class="bi bi-info-circle text-primary"></i>
                        <small class="text-muted">
                            Los precios se registran en dólares estadounidenses (USD) y admiten hasta dos decimales.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Control de existencias --}}
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-2">
                        <i class="bi bi-boxes fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Control de existencias</h6>
                        <small class="text-muted">Configuración de los niveles de inventario.</small>
                    </div>
                </div>
            </div>

            <div class="card-body px-4 pb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Stock mínimo <span class="text-danger">*</span></label>
                        <input type="number" name="stock_minimo" step="1" min="0"
                            class="form-control @error('stock_minimo') is-invalid @enderror"
                            value="{{ old('stock_minimo', $producto->stock_minimo ?? 5) }}"
                            placeholder="Ej. 5" required>
                        @error('stock_minimo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Se notificará cuando las existencias alcancen este nivel.</small>
                    </div>

                    @isset($producto)
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Stock actual</label>
                            <div class="form-control bg-light d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">{{ $producto->stock }} unidades</span>
                                <i class="bi bi-lock text-muted"></i>
                            </div>
                            <small class="text-muted">Se actualiza mediante entradas y ventas.</small>
                        </div>
                    @else
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="alert alert-info py-2 px-3 mb-0 w-100">
                                <i class="bi bi-info-circle me-1"></i>
                                El producto comenzará con <strong>0 unidades</strong> en existencia.
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Acciones --}}
<div class="d-flex justify-content-end gap-2 mt-4 mb-3">
    <a href="{{ route('productos.index') }}" class="btn btn-light border px-4">
        Cancelar
    </a>

    <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-check-lg me-1"></i>
        {{ isset($producto) ? 'Guardar cambios' : 'Registrar producto' }}
    </button>
</div>

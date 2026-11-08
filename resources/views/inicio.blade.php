@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Bienvenido al sistema</h3>
        <p class="text-muted mb-0">Resumen general del inventario de repuestos.</p>
    </div>

    <div class="row g-3">

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Productos</p>
                            <h3 class="fw-bold mb-0">0</h3>
                        </div>
                        <i class="bi bi-box-seam fs-2 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Entradas</p>
                            <h3 class="fw-bold mb-0">0</h3>
                        </div>
                        <i class="bi bi-box-arrow-in-down fs-2 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Ventas</p>
                            <h3 class="fw-bold mb-0">0</h3>
                        </div>
                        <i class="bi bi-cart3 fs-2 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-muted mb-1">Usuarios</p>
                            <h3 class="fw-bold mb-0">{{ \App\Models\User::count() }}</h3>
                        </div>
                        <i class="bi bi-people fs-2 text-info"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

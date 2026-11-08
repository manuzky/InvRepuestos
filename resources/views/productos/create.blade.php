@extends('layouts.app')

@section('title', 'Nuevo producto')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Nuevo producto</h4>
    <p class="text-muted mb-0">Registra un nuevo repuesto en el inventario.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('productos.store') }}" method="POST">
            @include('productos.form')
        </form>
    </div>
</div>
@endsection

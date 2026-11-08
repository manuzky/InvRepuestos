@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Editar producto</h4>
    <p class="text-muted mb-0">Modifica la información de {{ $producto->nombre }}.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('productos.update', $producto) }}" method="POST">
            @method('PUT')
            @include('productos.form')
        </form>
    </div>
</div>
@endsection

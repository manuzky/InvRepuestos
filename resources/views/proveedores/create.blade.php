@extends('layouts.app')

@section('title', 'Nuevo proveedor')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Nuevo proveedor</h4>
    <p class="text-muted mb-0">Registra un nuevo proveedor de repuestos.</p>
</div>

<form action="{{ route('proveedores.store') }}" method="POST">
    @csrf
    @include('proveedores.form')
</form>
@endsection

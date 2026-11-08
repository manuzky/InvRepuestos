@extends('layouts.app')

@section('title', 'Editar proveedor')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Editar proveedor</h4>
    <p class="text-muted mb-0">Modifica la información de {{ $proveedor->nombre }}.</p>
</div>

<form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
    @csrf
    @method('PUT')
    @include('proveedores.form')
</form>
@endsection

@extends('layouts.app')

@section('title', 'Nueva categoría')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Nueva categoría</h4>
    <p class="text-muted mb-0">Registra una nueva categoría de repuestos.</p>
</div>

<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    @include('categorias.form')
</form>
@endsection

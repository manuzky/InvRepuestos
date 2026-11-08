@extends('layouts.app')

@section('title', 'Editar categoría')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Editar categoría</h4>
    <p class="text-muted mb-0">Modifica la información de {{ $categoria->nombre }}.</p>
</div>

<form action="{{ route('categorias.update', $categoria) }}" method="POST">
    @csrf
    @method('PUT')
    @include('categorias.form')
</form>
@endsection

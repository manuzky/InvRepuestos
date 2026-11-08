@extends('layouts.app')

@section('title', 'Editar marca')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Editar marca</h4>
    <p class="text-muted mb-0">Modifica la información de {{ $marca->nombre }}.</p>
</div>

<form action="{{ route('marcas.update', $marca) }}" method="POST">
    @csrf
    @method('PUT')
    @include('marcas.form')
</form>
@endsection

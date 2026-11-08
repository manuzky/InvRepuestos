@extends('layouts.app')

@section('title', 'Nueva marca')

@section('content')
<div class="mb-4">
    <h4 class="mb-1">Nueva marca</h4>
    <p class="text-muted mb-0">Registra un fabricante de repuestos.</p>
</div>

<form action="{{ route('marcas.store') }}" method="POST">
    @csrf
    @include('marcas.form')
</form>
@endsection

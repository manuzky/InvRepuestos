@extends('layouts.app')

@section('title', 'Editar cliente')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h4 class="mb-1">Editar cliente</h4>
        <p class="text-muted mb-0">Modifica la información de {{ $cliente->nombre }}.</p>
    </div>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')
        @include('clientes.form')
    </form>

</div>
@endsection

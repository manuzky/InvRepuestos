@extends('layouts.app')

@section('title', 'Nuevo cliente')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h4 class="mb-1">Nuevo cliente</h4>
        <p class="text-muted mb-0">Registra un nuevo cliente en el sistema.</p>
    </div>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        @include('clientes.form')
    </form>

</div>
@endsection

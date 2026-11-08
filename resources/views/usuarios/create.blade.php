@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('content')
    <h3 class="mb-1">Nuevo usuario</h3>
    <p class="text-muted mb-4">Registra un empleado y configura su acceso.</p>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        @include('usuarios.form')

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-light">Cancelar</a>
            <button class="btn btn-primary">Guardar usuario</button>
        </div>
    </form>
@endsection

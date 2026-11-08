@extends('layouts.app')

@section('title', 'Nuevo cargo')

@section('content')
    <h3 class="fw-bold mb-1">Nuevo cargo</h3>
    <p class="text-muted mb-4">Registra un nuevo cargo para los empleados.</p>

    <form action="{{ route('cargos.store') }}" method="POST">
        @csrf
        @include('cargos.form')

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('cargos.index') }}" class="btn btn-light">Cancelar</a>
            <button class="btn btn-primary">Guardar cargo</button>
        </div>
    </form>
@endsection

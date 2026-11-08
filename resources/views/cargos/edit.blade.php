@extends('layouts.app')

@section('title', 'Editar cargo')

@section('content')
    <h3 class="fw-bold mb-1">Editar cargo</h3>
    <p class="text-muted mb-4">Modifica la información del cargo.</p>

    <form action="{{ route('cargos.update', $cargo) }}" method="POST">
        @csrf
        @method('PUT')

        @include('cargos.form')

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('cargos.index') }}" class="btn btn-light">Cancelar</a>
            <button class="btn btn-primary">Actualizar cargo</button>
        </div>
    </form>
@endsection

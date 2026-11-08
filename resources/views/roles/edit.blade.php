@extends('layouts.app')

@section('title', 'Editar rol')

@section('content')
    <h3 class="fw-bold mb-1">Editar rol</h3>
    <p class="text-muted mb-4">Modifica los permisos asociados a este rol.</p>

    <form action="{{ route('roles.update', ['role' => $rol->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @include('roles.form')

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('roles.index') }}" class="btn btn-light">
                Cancelar
            </a>

            <button type="submit" class="btn btn-primary">
                Actualizar rol
            </button>
        </div>
    </form>
@endsection

@extends('layouts.app')

@section('title', 'Editar usuario')

@section('content')
    <h3 class="mb-1">Editar usuario</h3>
    <p class="text-muted mb-4">Modifica la información y los accesos del empleado.</p>

    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')

        @include('usuarios.form')

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-light">Cancelar</a>
            <button class="btn btn-primary">Actualizar usuario</button>
        </div>
    </form>
@endsection

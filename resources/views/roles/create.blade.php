@extends('layouts.app')

@section('title', 'Nuevo rol')

@section('content')
    <h3 class="fw-bold mb-1">Nuevo rol</h3>
    <p class="text-muted mb-4">Define un rol y sus permisos de acceso.</p>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        @include('roles.form')

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('roles.index') }}" class="btn btn-light">Cancelar</a>
            <button class="btn btn-primary">Guardar rol</button>
        </div>
    </form>
@endsection

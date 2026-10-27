@extends('template.base')

@section('content')
<div class="container">
    <h1>Profesor</h1>
    <a href="{{ route('profesor.create') }}" class="btn btn-secondary mb-3">Crear Profesor</a>
    <a href="{{ route('profesor.index') }}" class="btn btn-secondary mb-3">Ver Profesores</a>
    <a href="{{ route('alumno.index') }}" class="btn btn-secondary mb-3">Ver Alumnos</a>
    <a href="{{ route('modulo.index') }}" class="btn btn-secondary mb-3">Ver Módulos</a>
    <hr>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="card-title">{{ $profesor->nombre }} {{ $profesor->apellidos }}</h2>
                    <p class="card-text">ID: {{ $profesor->id }}</p>
                    <p class="card-text">Especialidad: {{ $profesor->especialidad }}</p>
                    <p class="card-text">Fecha de alta: {{ Carbon\Carbon::parse($profesor->fecha_alta)->locale('es')->translatedFormat('j \d\e F \d\e Y') }}</p>
                    <p class="card-text">Salario: {{ number_format($profesor->salario, 2, ',', '.') }} €</p>
                    <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
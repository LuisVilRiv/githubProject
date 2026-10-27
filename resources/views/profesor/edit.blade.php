@extends('template.base')

@section('content')
<div class="container">
    <h1>Editar profesor</h1>
    <a href="{{ route('profesor.index') }}" class="btn btn-secondary mb-3">Ver Profesores</a>
    <a href="{{ route('alumno.index') }}" class="btn btn-secondary mb-3">Ver Alumnos</a>
    <a href="{{ route('modulo.index') }}" class="btn btn-secondary mb-3">Ver Módulos</a>
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update', $profesor) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" value="{{ old('nombre', $profesor->nombre) }}" class="form-control" id="nombre" name="nombre" required minlength="2" maxlength="100">
                    @error('nombre')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" value="{{ old('apellidos', $profesor->apellidos) }}" class="form-control" id="apellidos" name="apellidos" required minlength="3" maxlength="130">
                    @error('apellidos')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" value="{{ old('especialidad', $profesor->especialidad) }}" class="form-control" id="especialidad" name="especialidad" required maxlength="120">
                    @error('especialidad')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="fecha_alta" class="form-label">Fecha de alta</label>
                    <input type="date" value="{{ old('fecha_alta', $profesor->fecha_alta) }}" class="form-control" id="fecha_alta" name="fecha_alta" required max="{{ now()->format('Y-m-d') }}">
                    @error('fecha_alta')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="salario" class="form-label">Salario (€)</label>
                    <input type="number" value="{{ old('salario', $profesor->salario) }}" class="form-control" id="salario" name="salario" required min="0" max="99999999.99" step="0.01">
                    @error('salario')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-secondary">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
@endsection
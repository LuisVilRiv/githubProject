@extends('template.base')

@section('content')
<div class="container">
    <h1>Profesores</h1>
    <a href="{{ route('profesor.create') }}" class="btn btn-secondary mb-3">Crear Profesor</a>
    <a href="{{ route('profesor.index') }}" class="btn btn-secondary mb-3">Ver Profesores</a>
    <a href="{{ route('alumno.index') }}" class="btn btn-secondary mb-3">Ver Alumnos</a>
    <a href="{{ route('modulo.index') }}" class="btn btn-secondary mb-3">Ver Módulos</a>
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Especialidad</th>
                        <th>Fecha de alta</th>
                        <th>Salario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profesores as $profesor)
                        <tr>
                            <td>{{ $profesor->id }}</td>
                            <td>{{ $profesor->nombre }}</td>
                            <td>{{ $profesor->apellidos }}</td>
                            <td>{{ $profesor->especialidad }}</td>
                            <td>{{ Carbon\Carbon::parse($profesor->fecha_alta)->locale('es')->translatedFormat('d/m/Y') }}</td>
                            <td>{{ number_format($profesor->salario, 2, ',', '.') }} €</td>
                            <td>
                                <a href="{{ route('profesor.show', $profesor) }}" class="btn btn-secondary">Ver</a>
                                <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a>
                                <form data-message="{{ $profesor->apellidos . ', ' . $profesor->nombre }}" class="confirm-dialog" action="{{ route('profesor.destroy', $profesor) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Borrar" class="btn btn-secondary">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('form.confirm-dialog').forEach(form => {
        form.addEventListener('submit', event => {
            const message = '¿Seguro que quieres borrar al profesor ' + form.dataset.message + '?';
            if (!confirm(message)) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection
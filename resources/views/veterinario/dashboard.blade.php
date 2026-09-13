@extends('layouts.veterinario')

@section('titulo', 'Mis Citas')

@section('contenido')
<h1 class="page-title">Citas por Confirmar</h1>
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Dueño</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Categoría</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($citasPorConfirmar as $cita)
                <tr>
                    <td>{{ $cita->mascota->nombre_mascota }}</td>
                    <td>{{ $cita->mascota->dueno->nombreCompleto() }}</td>
                    <td>{{ $cita->fecha_cita->format('d/m/Y') }}</td>
                    <td>{{ $cita->fecha_cita->format('h:i A') }}</td>
                    <td>{{ $cita->categoria }}</td>
                    <td>
                        <form action="{{ route('veterinario.citas.aceptar', $cita) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Aceptar Cita
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No tienes citas pendientes por confirmar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<br>

<h1 class="page-title">Citas Confirmadas</h1>
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Dueño</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Categoría</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($citasConfirmadas as $cita)
                <tr>
                    <td>{{ $cita->mascota->nombre_mascota }}</td>
                    <td>{{ $cita->mascota->dueno->nombreCompleto() }}</td>
                    <td>{{ $cita->fecha_cita->format('d/m/Y') }}</td>
                    <td>{{ $cita->fecha_cita->format('h:i A') }}</td>
                    <td>{{ $cita->categoria }}</td>
                    <td>
                        <a href="{{ route('veterinario.historias.create', $cita) }}" class="btn btn-primary">
                            Registrar Historia Clínica
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aún no tienes citas confirmadas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

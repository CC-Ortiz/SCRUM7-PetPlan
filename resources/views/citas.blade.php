@extends('layouts.dashboard')

@section('titulo', 'Citas')

@section('contenido')
<h1 class="page-title">Gestión de Citas</h1>
<div class="section-header">
    <h2>Citas Programadas</h2>
    <a href="{{ route('citas.create') }}" class="btn btn-primary">
        + Agendar Cita
    </a>
</div>
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Categoría</th>
                <th>Veterinario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($citas as $cita)
                <tr>
                    <td>{{ $cita->mascota->nombre_mascota }}</td>
                    <td>{{ $cita->fecha_cita->format('d/m/Y') }}</td>
                    <td>{{ $cita->fecha_cita->format('h:i A') }}</td>
                    <td>{{ $cita->categoria }}</td>
                    <td>{{ $cita->veterinarios->map->nombreCompleto()->join(', ') ?: 'Sin asignar' }}</td>
                    <td>
                        @if ($cita->confirmacion)
                            <span class="badge success">Confirmada</span>
                        @else
                            <span class="badge warning">Pendiente</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No tienes citas programadas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

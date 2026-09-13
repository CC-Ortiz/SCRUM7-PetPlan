@extends('layouts.dashboard')

@section('titulo', 'Vacunas')

@section('contenido')
<h1 class="page-title">Control de Vacunas</h1>
<div class="section-header">
    <h2>Vacunas Registradas</h2>
    <a href="{{ route('historial.index') }}" class="btn btn-primary">
        Ver Historial Clínico
    </a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Mascota</th>
                <th>Vacuna Recomendada</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vacunas as $registro)
                <tr>
                    <td>{{ $registro->mascota->nombre_mascota }}</td>
                    <td>{{ $registro->vacuna_recomendada }}</td>
                    <td>{{ optional($registro->fecha_registro)->format('d/m/Y') ?? $registro->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aún no hay vacunas recomendadas en la historia clínica de tus mascotas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

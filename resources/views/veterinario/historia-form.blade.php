@extends('layouts.veterinario')

@section('titulo', 'Registrar Historia Clínica')

@section('contenido')
<h1 class="page-title">
    Historia Clínica — {{ $cita->mascota->nombre_mascota }}
    <small style="font-weight:400; display:block; font-size: 14px;">
        Dueño: {{ $cita->mascota->dueno->nombreCompleto() }} ·
        Cita del {{ $cita->fecha_cita->format('d/m/Y h:i A') }}
    </small>
</h1>

<div class="form-card">
    <form action="{{ route('veterinario.historias.store', $cita) }}" method="POST">
        @csrf
        <div class="form-grupo">
            <label>Diagnóstico</label>
            <input type="text" name="diagnostico" value="{{ old('diagnostico') }}" placeholder="Ej. Otitis leve">
        </div>
        <div class="form-grupo">
            <label>Tratamiento</label>
            <input type="text" name="tratamiento" value="{{ old('tratamiento') }}" placeholder="Ej. Gotas óticas por 7 días">
        </div>
        <div class="form-grupo">
            <label>Vacuna Recomendada</label>
            <input type="text" name="vacuna_recomendada" value="{{ old('vacuna_recomendada') }}" placeholder="Ej. Refuerzo antirrábico en 6 meses">
        </div>
        <div class="form-grupo">
            <label>Notas de la Historia Clínica</label>
            <textarea name="historia_clinica" rows="5" required placeholder="Describe la consulta, hallazgos y recomendaciones...">{{ old('historia_clinica') }}</textarea>
        </div>
        <button class="btn btn-primary">
            Guardar Historia Clínica
        </button>
    </form>
</div>
@endsection

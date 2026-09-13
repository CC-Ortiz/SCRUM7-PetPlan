@extends('layouts.dashboard')

@section('titulo', 'Agendar Cita')

@section('contenido')
<h1 class="page-title">Agendar Cita</h1>
<div class="form-card">
    @if ($mascotas->isEmpty())
        <p>
            Necesitas registrar al menos una mascota antes de agendar una cita.
            <a href="{{ route('mascotas.create') }}" class="btn btn-primary">Registrar Mascota</a>
        </p>
    @else
        <form action="{{ route('citas.store') }}" method="POST">
            @csrf
            <div class="form-grupo">
                <label>Mascota</label>
                <select name="id_mascota" required>
                    @foreach ($mascotas as $mascota)
                        <option value="{{ $mascota->id_mascota }}" @selected(old('id_mascota') == $mascota->id_mascota)>
                            {{ $mascota->nombre_mascota }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-grupo">
                <label>Fecha</label>
                <input type="date" name="fecha" value="{{ old('fecha') }}" required>
            </div>
            <div class="form-grupo">
                <label>Hora</label>
                <input type="time" name="hora" value="{{ old('hora') }}" required>
            </div>
            <div class="form-grupo">
                <label>Categoría</label>
                <select name="categoria">
                    @foreach (['Consulta General', 'Vacunación', 'Control', 'Baño'] as $categoria)
                        <option value="{{ $categoria }}" @selected(old('categoria') == $categoria)>{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-grupo">
                <label>Veterinario</label>
                <select name="id_veterinario">
                    <option value="">Según disponibilidad</option>
                    @foreach ($veterinarios as $veterinario)
                        <option value="{{ $veterinario->id_veterinario }}" @selected(old('id_veterinario') == $veterinario->id_veterinario)>
                            {{ $veterinario->nombreCompleto() }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-grupo">
                <label>Observaciones</label>
                <textarea name="descripcion" rows="4" placeholder="Escribe cualquier observación relevante...">{{ old('descripcion') }}</textarea>
            </div>
            <button class="btn btn-primary">
                Confirmar Cita
            </button>
        </form>
    @endif
</div>
@endsection

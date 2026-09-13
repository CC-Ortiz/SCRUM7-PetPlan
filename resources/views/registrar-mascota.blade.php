@extends('layouts.dashboard')

@section('titulo', 'Registrar Mascota')

@section('contenido')
<h1 class="page-title">Registrar Mascota</h1>
<div class="form-card">
    <form action="{{ route('mascotas.store') }}" method="POST">
        @csrf
        <div class="form-grupo">
            <label>Nombre</label>
            <input type="text" name="nombre_mascota" value="{{ old('nombre_mascota') }}" required>
        </div>
        <div class="form-grupo">
            <label>Especie / Raza</label>
            <select name="id_tipo_mascota" required>
                @foreach ($tiposMascota as $tipo)
                    <option value="{{ $tipo->id_tipo_mascota }}" @selected(old('id_tipo_mascota') == $tipo->id_tipo_mascota)>
                        {{ $tipo->nombre_tipo_mascota }} - {{ $tipo->nombre_raza }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-grupo">
            <label>Edad</label>
            <input type="text" name="edad_mascota" value="{{ old('edad_mascota') }}" required
            placeholder="Ej. 3 años">
        </div>
        <div class="form-grupo">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
        </div>
        <div class="form-grupo">
            <label>Peso (kg)</label>
            <input type="text" name="peso_mascota" value="{{ old('peso_mascota') }}" required
            placeholder="Peso de la mascota">
        </div>
        <div class="form-grupo">
            <label>Color</label>
            <input type="text" name="color_mascota" value="{{ old('color_mascota') }}"
            placeholder="Color de la mascota">
        </div>
        <div class="form-grupo">
            <label>Observaciones</label>
            <textarea name="observaciones" rows="4" placeholder="Escribe cualquier observación relevante...">{{ old('observaciones') }}</textarea>
        </div>
        <button class="btn btn-primary">
            Guardar Mascota
        </button>
    </form>
</div>
@endsection

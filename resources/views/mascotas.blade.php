@extends('layouts.dashboard')

@section('titulo', 'Mis Mascotas')

@section('contenido')
<h1 class="page-title">Mis Mascotas</h1>
<div class="section-header">
    <h2>Mascotas Registradas</h2>
    <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
        + Nueva Mascota
    </a>
</div>
<div class="pet-grid">
    @forelse ($mascotas as $mascota)
        <div class="pet-card">
            <div class="pet-avatar">
                {{ $mascota->tipoMascota->nombre_tipo_mascota === 'Gato' ? '🐱' : '🐶' }}
            </div>
            <h3>{{ $mascota->nombre_mascota }}</h3>
            <p>{{ $mascota->tipoMascota->nombre_raza }}</p>
            <p>{{ $mascota->edad_mascota }}</p>
        </div>
    @empty
        <p>Aún no has registrado ninguna mascota.</p>
    @endforelse
</div>
@endsection

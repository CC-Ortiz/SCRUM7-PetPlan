@extends('layouts.dashboard')

@section('titulo', 'Historial Clínico')

@section('contenido')
<h1 class="page-title">Historial Clínico</h1>
<div class="history-container">
    @forelse ($historias as $historia)
        <div class="history-card">
            <div class="history-header">
                <h3>{{ $historia->mascota->nombre_mascota }}</h3>
                <span>{{ optional($historia->fecha_registro)->format('d M Y') ?? $historia->created_at->format('d M Y') }}</span>
            </div>
            <p>{{ $historia->historia_clinica }}</p>
            @if ($historia->diagnostico)
                <p>Diagnóstico: {{ $historia->diagnostico }}</p>
            @endif
            @if ($historia->tratamiento)
                <p>Tratamiento: {{ $historia->tratamiento }}</p>
            @endif
            @if ($historia->veterinarios->isNotEmpty())
                <p>Atendido por: {{ $historia->veterinarios->map->nombreCompleto()->join(', ') }}</p>
            @endif
        </div>
    @empty
        <p>Todavía no hay registros en el historial clínico de tus mascotas.</p>
    @endforelse
</div>
@endsection

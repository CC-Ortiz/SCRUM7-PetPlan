@extends('layouts.dashboard')

@section('titulo', 'Mi Panel')

@section('contenido')
    <h1 class="page-title">
        Resumen de tus Mascotas
    </h1>
    <!-- ESTADÍSTICAS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon green-bg">
                🐶
            </div>
            <div>
                <h3>Mascotas Registradas</h3>
                <p class="stat-number">{{ $totalMascotas }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue-bg">
                📅
            </div>
            <div>
                <h3>Citas Pendientes</h3>
                <p class="stat-number">{{ $citasPendientes }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green-bg">
                💉
            </div>
            <div>
                <h3>Vacunas Registradas</h3>
                <p class="stat-number">{{ $vacunasProximas }}</p>
            </div>
        </div>
    </div>
    <!-- PRÓXIMAS CITAS -->
    <div class="card">
        <div class="card-header">
            <h2>Próximas Citas</h2>
        </div>
        <ul class="activity-list">
            @forelse ($proximasCitas as $cita)
                <li>
                    <div class="activity-icon">
                        📅
                    </div>
                    <div class="activity-text">
                        <p>
                            <strong>{{ $cita->mascota->nombre_mascota }}</strong> - {{ $cita->categoria }}
                        </p>
                        <span class="time">
                            {{ $cita->fecha_cita->format('d/m/Y - h:i A') }}
                        </span>
                    </div>
                </li>
            @empty
                <li>
                    <div class="activity-text">
                        <p>No tienes citas próximas.</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
    <br>
    <!-- RECORDATORIOS -->
    <div class="card">
        <div class="card-header">
            <h2>Recordatorios</h2>
        </div>
        <ul class="activity-list">
            @forelse ($recordatorios as $historia)
                <li>
                    <div class="activity-icon">
                        🔔
                    </div>
                    <div class="activity-text">
                        <p>
                            Vacuna recomendada para
                            <strong>{{ $historia->mascota->nombre_mascota }}</strong>:
                            {{ $historia->vacuna_recomendada }}
                        </p>
                    </div>
                </li>
            @empty
                <li>
                    <div class="activity-text">
                        <p>No tienes recordatorios pendientes.</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
@endsection

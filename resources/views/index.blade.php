@extends('layouts.app')

@section('titulo', 'Inicio')

@section('nav-links')
    <li><a href="#beneficios"> Beneficios </a></li>
    <li><a href="#servicios"> Servicios </a></li>
    <li> <a href="{{ route('login') }}" class="btn btn-primary"> Iniciar Sesión </a> </li>
    <li> <a href="{{ route('registro') }}" class="btn btn-secundary"> Registrarse </a> </li>
@endsection

@section('contenido')

    <!-- HERO -->
    <section id="inicio" class="hero">
        <div class="container hero-container">

            <div class="hero-content">
                <h1> Gestiona el cuidado de las mascotas de forma eficiente </h1>
                <p>
                    PetPlan es una plataforma diseñada para optimizar la gestión veterinaria mediante el control de citas, vacunas e historial clínico.
                    Facilita el seguimiento de los cuidados de las mascotas y mejora la organización tanto para veterinarios como para dueños.
                </p>

                <div class="hero-buttons">
                    <a href="#servicios" class="btn btn-primary"> Conocer Más </a>
                </div>
        </div>
    </section>

    <!-- BENEFICIOS -->
    <section id="beneficios" class="beneficios">
        <div class="container">

            <h2 class="text-center">
                ¿Por qué elegir PetPlan?
            </h2>

            <div class="services-grid">

                <div class="service-card">
                    <i class="fas fa-clock"></i>
                    <h3>Ahorro de Tiempo</h3>
                    <p>
                        Agenda citas de manera rápida y organizada, evitando procesos manuales y reduciendo errores en la programación de consultas.
                    </p>
                </div>

                <div class="service-card">
                    <i class="fas fa-folder-open"></i>
                    <h3>Información Centralizada</h3>
                    <p>
                        Mantén toda la información de las mascotas en un solo lugar, incluyendo historial clínico, vacunas y tratamientos.
                    </p>
                </div>

                <div class="service-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Mejor Seguimiento</h3>
                    <p>
                        Facilita el control de vacunas, consultas y procedimientos, permitiendo un monitoreo constante del bienestar de las mascotas.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- SERVICIOS -->
    <section id="servicios" class="services">
        <div class="container">

            <h2 class="text-center">
                Nuestros Servicios
            </h2>

            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Gestión de Citas</h3>
                    <p> Permite programar y administrar citas veterinarias según la disponibilidad, ayudando a reducir olvidos y mejorar la atención.</p>
                </div>

                <div class="service-card">
                    <i class="fas fa-notes-medical"></i>
                    <h3>Historial Clínico</h3>
                    <p> Registra diagnósticos, tratamientos, vacunas y procedimientos realizados para mantener un control completo de cada mascota. </p>
                </div>

                <div class="service-card">
                    <i class="fas fa-syringe"></i>
                    <h3>Control de Vacunas</h3>
                    <p> Lleva el seguimiento de vacunas aplicadas y recomendaciones futuras para garantizar una adecuada prevención y cuidado.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- SOBRE NOSOTROS -->
    <section class="about">
        <div class="container">
            <h2>Sobre Nosotros</h2>
            <p> PetPlan nace como una solución tecnológica para mejorar la organización y gestión de la información en veterinarias. Actualmente, muchos procesos relacionados con citas, vacunas y cuidados de mascotas se realizan mediante agendas o registros físicos, lo que puede ocasionar pérdida de información y falta de seguimiento. </p>
            <p> Nuestro objetivo es ofrecer una plataforma que permita a veterinarios y dueños de mascotas gestionar de manera eficiente los cuidados, tratamientos e historiales clínicos, contribuyendo a una mejor calidad de vida para las mascotas. </p>
        </div>
    </section>

@endsection

@extends('tienda.layout')

@section('title', 'Contacto - Bajo Cero')

@section('styles')
<style>
    .contact-header {
        padding: 6rem 0 4rem;
        text-align: center;
        background: linear-gradient(to bottom, var(--bg-main), var(--bg-surface));
    }

    .contact-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        color: var(--text-main);
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    .contact-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        padding: 2.5rem;
        height: 100%;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .info-icon {
        background: rgba(102, 252, 241, 0.1);
        color: var(--accent-neon);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.5rem;
        margin-right: 1.5rem;
        flex-shrink: 0;
    }

    .info-title {
        color: var(--text-main);
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .info-text {
        color: var(--text-muted);
        margin: 0;
        line-height: 1.6;
    }

    .form-control, .form-select, textarea {
        background: var(--bg-main);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        padding: 1rem;
        border-radius: 0;
    }

    .form-control:focus, textarea:focus {
        background: var(--bg-main);
        border-color: var(--accent-neon);
        color: var(--text-main);
        box-shadow: var(--glow);
    }

    .btn-send {
        background: var(--accent-neon);
        color: var(--bg-main);
        font-weight: 800;
        text-transform: uppercase;
        padding: 1rem 2rem;
        border: none;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-send:hover {
        background: #fff;
        box-shadow: var(--glow);
    }

    .map-container {
        height: 400px;
        width: 100%;
        border: 1px solid var(--border-color);
        filter: grayscale(100%) invert(92%) contrast(83%);
    }
</style>
@endsection

@section('content')
<header class="contact-header">
    <div class="container-fluid px-4 px-lg-5">
        <h1 class="contact-title">Contáctanos</h1>
        <p class="text-muted fs-5">Estamos aquí para ayudarte. Escríbenos o visítanos.</p>
    </div>
</header>

<div class="container-fluid px-4 px-lg-5 pb-5">
    <div class="row g-5">
        <!-- Información de Contacto -->
        <div class="col-lg-5">
            <div class="contact-card">
                <h3 class="mb-4 text-white" style="font-family: 'Outfit', sans-serif;">Información</h3>
                
                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <h5 class="info-title">Ubicación</h5>
                        <p class="info-text">
                            San Victorino, Bogotá D.C.<br>
                            Calle 10 #10-25, Local 105
                        </p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-whatsapp"></i></div>
                    <div>
                        <h5 class="info-title">WhatsApp</h5>
                        <p class="info-text">
                            <a href="https://wa.me/573212335821" class="text-decoration-none text-muted hover-neon">
                                +57 321 233 5821
                            </a>
                        </p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-envelope"></i></div>
                    <div>
                        <h5 class="info-title">Email</h5>
                        <p class="info-text">
                            info@bajocero.com<br>
                            soporte@bajocero.com
                        </p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-clock"></i></div>
                    <div>
                        <h5 class="info-title">Horario</h5>
                        <p class="info-text">
                            Lunes - Sábado: 9:00 AM - 7:00 PM<br>
                            Domingos: Cerrado
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <div class="col-lg-7">
            <div class="contact-card">
                <h3 class="mb-4 text-white" style="font-family: 'Outfit', sans-serif;">Envíanos un Mensaje</h3>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Nombre Completo">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Correo Electrónico">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Asunto">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" rows="5" placeholder="Tu mensaje..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-send" onclick="alert('Mensaje enviado (Simulación)')">
                                ENVIAR MENSAJE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mapa -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.996767645876!2d-74.0817486852379!3d4.605658996654032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99a0f9c753f5%3A0x608763e72f0c0!2sSan%20Victorino!5e0!3m2!1ses!2sco!4v1625164825642!5m2!1ses!2sco" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

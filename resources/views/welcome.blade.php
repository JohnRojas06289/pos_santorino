@extends('tienda.layout')

@section('title', 'Inicio - Bajo Cero')

@section('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: var(--hero-overlay), url('https://images.unsplash.com/photo-1551488852-d814c937c191?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        min-height: 85vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 900;
        line-height: 0.9;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        color: var(--text-main);
    }

    .hero-title span {
        color: transparent;
        -webkit-text-stroke: 2px var(--accent-neon);
        display: block;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: var(--text-muted);
        max-width: 600px;
        margin-bottom: 2.5rem;
        font-family: 'Rajdhani', sans-serif;
        font-weight: 500;
    }

    /* Features Section */
    .features-section {
        padding: 5rem 0;
        background-color: var(--bg-main);
        position: relative;
    }

    .feature-card {
        background: var(--bg-surface);
        padding: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-neon);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: bottom;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .feature-card:hover::before {
        transform: scaleY(1);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--accent-neon);
        margin-bottom: 1.5rem;
    }

    .feature-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-main);
    }

    .feature-text {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 0;
        background: linear-gradient(45deg, var(--bg-surface), var(--bg-main));
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
        text-align: center;
    }

    .cta-title {
        font-family: 'Outfit', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--text-main);
    }

    .cta-text {
        color: var(--text-muted);
        font-size: 1.2rem;
        margin-bottom: 2.5rem;
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Estilo Que
                            <span>Desafía</span>
                        </h1>
                        <p class="hero-subtitle">
                            Descubre la nueva colección de chaquetas y gorras diseñadas para la vida urbana. 
                            Calidad premium, diseño exclusivo y la actitud que necesitas.
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('tienda.index') }}#catalogo" class="btn btn-primary btn-lg">
                                Ver Colección
                            </a>
                            <a href="#contacto" class="btn btn-outline-light btn-lg rounded-0 px-4 fw-bold text-uppercase" style="border: 2px solid var(--text-main); color: var(--text-main);">
                                Contactar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="bi bi-shield-check feature-icon"></i>
                        <h3 class="feature-title">Calidad Premium</h3>
                        <p class="feature-text">
                            Materiales seleccionados rigurosamente para garantizar durabilidad y confort en cada prenda.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="bi bi-lightning-charge feature-icon"></i>
                        <h3 class="feature-title">Diseño Exclusivo</h3>
                        <p class="feature-text">
                            Ediciones limitadas y diseños únicos que no encontrarás en ningún otro lugar.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="bi bi-box-seam feature-icon"></i>
                        <h3 class="feature-title">Envío Seguro</h3>
                        <p class="feature-text">
                            Recibe tus productos en la puerta de tu casa con total garantía y seguimiento en tiempo real.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">¿LISTO PARA EL SIGUIENTE NIVEL?</h2>
            <p class="cta-text">Explora nuestro catálogo completo y encuentra tu estilo.</p>
            <a href="{{ route('tienda.index') }}#catalogo" class="btn btn-primary btn-lg">
                Ir al Catálogo
            </a>
        </div>
    </section>
@endsection

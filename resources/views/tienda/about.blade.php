@extends('tienda.layout')

@section('title', 'Quiénes Somos - Bajo Cero')

@section('styles')
<style>
    .about-header {
        background: linear-gradient(rgba(11, 12, 16, 0.8), rgba(11, 12, 16, 0.9)), url('https://images.unsplash.com/photo-1523398002811-999ca8dec234?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        padding: 8rem 0 6rem;
        text-align: center;
        position: relative;
    }

    .about-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(to top, var(--bg-main), transparent);
    }

    .about-title {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .about-subtitle {
        font-size: 1.2rem;
        color: var(--text-muted);
        max-width: 700px;
        margin: 0 auto;
        font-family: 'Rajdhani', sans-serif;
    }

    .content-section {
        padding: 5rem 0;
    }

    .story-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }

    .story-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-neon);
    }

    .story-title {
        color: var(--accent-neon);
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .story-text {
        color: var(--text-muted);
        line-height: 1.8;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .team-card {
        background: var(--bg-surface);
        border: 1px solid transparent;
        transition: all 0.3s ease;
        text-align: center;
        padding: 2rem;
    }

    .team-card:hover {
        border-color: var(--accent-neon);
        transform: translateY(-10px);
        box-shadow: var(--glow);
    }

    .team-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1.5rem;
        border: 3px solid var(--accent-neon);
        padding: 5px;
    }

    .team-name {
        color: var(--text-main);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .team-role {
        color: var(--accent-dim);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endsection

@section('content')
<!-- Header -->
<header class="about-header">
    <div class="container position-relative z-2">
        <h1 class="about-title">Nuestra Historia</h1>
        <p class="about-subtitle">
            Más que una marca, somos un movimiento. Nacidos en las calles, diseñados para destacar.
        </p>
    </div>
</header>

<!-- Historia -->
<section class="content-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="story-card">
                    <h2 class="story-title">El Origen</h2>
                    <p class="story-text">
                        Bajo Cero nació en 2020 con una misión clara: redefinir la moda urbana en Bogotá. 
                        Lo que comenzó como un pequeño proyecto de diseño de gorras personalizadas, 
                        se transformó rápidamente en una marca referente de estilo y calidad.
                    </p>
                    <p class="story-text">
                        Nos inspiramos en la arquitectura de la ciudad, el arte callejero y la música 
                        para crear prendas que no solo visten, sino que expresan una identidad. 
                        Cada chaqueta y cada gorra cuenta una historia de resistencia y autenticidad.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="img-fluid rounded border border-secondary" alt="Taller">
                    </div>
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="img-fluid rounded border border-secondary mt-4" alt="Moda Urbana">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Valores -->
<section class="content-section bg-darker" style="background: rgba(0,0,0,0.3);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="story-title" style="font-size: 2.5rem;">Nuestros Valores</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="team-card">
                    <i class="bi bi-gem fs-1 text-info mb-3"></i>
                    <h4 class="team-name">Calidad Premium</h4>
                    <p class="text-muted">No negociamos con la calidad. Utilizamos los mejores materiales para garantizar durabilidad.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-card">
                    <i class="bi bi-palette fs-1 text-info mb-3"></i>
                    <h4 class="team-name">Diseño Original</h4>
                    <p class="text-muted">Creamos tendencias, no las seguimos. Cada colección es única y limitada.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="team-card">
                    <i class="bi bi-people fs-1 text-info mb-3"></i>
                    <h4 class="team-name">Comunidad</h4>
                    <p class="text-muted">Somos una familia. Apoyamos el talento local y la cultura urbana.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

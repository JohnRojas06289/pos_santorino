@extends('tienda.layout')

@section('title', 'Inicio - Bajo Cero')

@section('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(11, 12, 16, 0.6), rgba(11, 12, 16, 0.8)), url('{{ asset("images/hero-cyberpunk.jpg") }}');
        background-size: cover;
        background-position: center;
        height: calc(100vh - 93px); /* Strict height (Navbar = 93px) */
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    [data-theme="light"] .hero-section {
        background: var(--bg-main);
        background-image: none;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 6rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        text-shadow: 0 0 20px rgba(0,0,0,0.5);
        color: var(--text-main);
    }

    .hero-title span {
        color: transparent;
        -webkit-text-stroke: 2px var(--accent-neon);
        display: block;
        position: relative;
    }

    /* Jacket Hero Image */
    .hero-jacket-container {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-jacket {
        max-width: 450px;
        width: 100%;
        height: auto;
        filter: drop-shadow(0 0 30px rgba(102, 252, 241, 0.3));
        transition: all 0.3s ease;
    }

    .hero-jacket:hover {
        filter: drop-shadow(0 0 50px rgba(102, 252, 241, 0.5));
        transform: scale(1.05);
    }

    /* Glow effect behind jacket */
    .jacket-glow {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(102, 252, 241, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.8; }
    }

    .hero-title span::before {
        content: 'Desafía';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        color: var(--accent-neon);
        overflow: hidden;
        border-right: 4px solid var(--accent-neon);
        transition: width 0.5s ease;
        -webkit-text-stroke: 0;
    }

    .hero-title:hover span::before {
        width: 100%;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: var(--text-muted);
        margin-bottom: 2.5rem;
        max-width: 600px;
        text-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    /* Features Section */
    .features-section {
        padding: 5rem 0;
        background: var(--bg-main);
        position: relative;
    }

    .feature-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border-color);
        padding: 2rem;
        transition: all 0.3s ease;
        height: 100%;
        backdrop-filter: blur(10px);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent-neon);
        box-shadow: 0 10px 30px rgba(102, 252, 241, 0.1);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: var(--accent-neon);
        margin-bottom: 1.5rem;
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-main);
    }

    .feature-text {
        color: var(--text-muted);
        font-size: 1rem;
        line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
        height: calc(100vh - 93px); /* Strict height (Navbar = 93px) */
        display: flex;
        align-items: center;
        padding: 0;
        background: linear-gradient(45deg, var(--bg-surface), var(--bg-main));
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* CTA Image Constraint */
    .cta-image {
        max-height: 80vh;
        width: auto;
        max-width: 100%;
        object-fit: contain;
    }

    /* ... (unchanged styles) ... */

    /* TikTok Section */
    .tiktok-section {
        padding: 5rem 0;
        background: var(--bg-main);
        position: relative;
    }

    .tiktok-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 3rem;
        color: var(--text-main);
    }

    .tiktok-title span {
        color: var(--accent-neon);
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-fluid px-4 px-lg-5">
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
                <!-- Jacket Hero Image -->
                <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative" style="height: 500px;">
                    <div class="hero-jacket-container" id="jacketContainer">
                        <div class="jacket-glow"></div>
                        <img src="{{ asset('images/jacket-neon.jpg') }}" alt="Chaqueta Bajo Cero" class="hero-jacket" id="heroJacket">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container-fluid px-4 px-lg-5">
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
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center h-100">
                <div class="col-lg-6 text-start">
                    <h2 class="cta-title">¿LISTO PARA EL SIGUIENTE NIVEL?</h2>
                    <p class="cta-text">Explora nuestro catálogo completo y encuentra tu estilo. La colección Neon Edition ya está disponible.</p>
                    <a href="{{ route('tienda.index') }}#catalogo" class="btn btn-primary btn-lg">
                        Ir al Catálogo
                    </a>
                </div>
                <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center position-relative" style="height: 100vh;">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 120%; height: 120%; background: radial-gradient(circle, var(--accent-neon) 0%, transparent 70%); opacity: 0.1; z-index: 0;"></div>
                    <img src="{{ asset('images/jacket-neon.jpg') }}" alt="Chaqueta Neon" class="cta-image position-relative" style="z-index: 1; border-radius: 20px; box-shadow: 0 0 30px rgba(102, 252, 241, 0.2); transform: rotate(-5deg); border: 1px solid rgba(102, 252, 241, 0.3);">
                </div>
            </div>
        </div>
    </section>

    <!-- TikTok Section -->
    <section class="tiktok-section">
        <div class="container-fluid px-4 px-lg-5">
            <h2 class="tiktok-title">SÍGUENOS EN <span>TIKTOK</span></h2>
            <div class="d-flex justify-content-center">
                <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@chaquetas.bajo.ce" data-unique-id="chaquetas.bajo.ce" data-embed-type="creator" style="max-width: 780px; min-width: 288px;" > 
                    <section> 
                        <a target="_blank" href="https://www.tiktok.com/@chaquetas.bajo.ce?refer=creator_embed">@chaquetas.bajo.ce</a> 
                    </section> 
                </blockquote>
            </div>
            <div class="text-center mt-5">
                <a href="https://www.tiktok.com/@chaquetas.bajo.ce?_r=1&_t=ZS-91b4qMLKj1c" target="_blank" class="btn btn-outline-light rounded-0 px-5 py-3 fw-bold" style="border: 2px solid var(--accent-neon); color: var(--text-main);">
                    VER PERFIL COMPLETO
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jacket = document.getElementById('heroJacket');
        const container = document.getElementById('jacketContainer');
        
        if (!jacket || !container) return;

        // Floating animation
        gsap.to(jacket, {
            y: -20,
            duration: 2,
            ease: 'power1.inOut',
            yoyo: true,
            repeat: -1
        });

        // Parallax effect on mouse move
        container.addEventListener('mousemove', (e) => {
            const rect = container.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const moveX = (x - centerX) / 20;
            const moveY = (y - centerY) / 20;
            
            gsap.to(jacket, {
                x: moveX,
                y: moveY,
                duration: 0.5,
                ease: 'power2.out'
            });
        });

        // Reset position when mouse leaves
        container.addEventListener('mouseleave', () => {
            gsap.to(jacket, {
                x: 0,
                y: 0,
                duration: 0.5,
                ease: 'power2.out'
            });
        });
    });
</script>
<script async src="https://www.tiktok.com/embed.js"></script>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Bajo Cero - Tu tienda especializada en chaquetas y gorras de última tendencia. Estilo urbano, calidad y diseño en cada prenda." />
    <meta name="author" content="Bajo Cero" />
    <title>Bajo Cero - Chaquetas y Gorras Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            /* Paleta basada en el logo */
            --blue-dark: #1D3557;
            --blue-medium: #457B9D;
            --blue-light: #A8DADC;
            --cream: #F1FAEE;
            --accent: #E63946;
            --text-dark: #0A0A0A;
            --text-light: #FFFFFF;
            --text-gray: #6B7280;
            --border: rgba(29, 53, 87, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Navbar Moderno y Urbano */
        .navbar {
            background: rgba(241, 250, 238, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--blue-light);
            padding: 1.2rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(29, 53, 87, 0.1);
        }

        .navbar.scrolled {
            background: rgba(241, 250, 238, 0.98) !important;
            box-shadow: 0 4px 30px rgba(29, 53, 87, 0.15);
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--blue-dark) !important;
            letter-spacing: -0.5px;
            transition: transform 0.3s ease;
            position: relative;
        }

        .navbar-brand::after {
            content: '00';
            position: absolute;
            top: -5px;
            left: -25px;
            font-size: 1.2rem;
            opacity: 0.3;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: var(--blue-medium) !important;
        }

        .nav-link {
            color: var(--blue-dark) !important;
            font-weight: 500;
            font-size: 0.95rem;
            margin: 0 0.5rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--blue-medium);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--blue-medium) !important;
        }

        .btn-danger {
            background: var(--blue-dark);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border-radius: 4px;
            color: var(--text-light);
        }

        .btn-danger:hover {
            background: var(--blue-medium);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(29, 53, 87, 0.3);
            color: var(--text-light);
        }

        /* Hero Section Moderno y Urbano */
        .hero-section {
            position: relative;
            min-height: 85vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(135deg, var(--cream) 0%, var(--blue-light) 100%);
        }

        .carousel-item {
            height: 85vh;
            position: relative;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .carousel-caption {
            bottom: 25%;
            left: 10%;
            right: 10%;
            text-align: left;
        }

        .carousel-caption h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 6vw, 5.5rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-light);
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.5);
            line-height: 1.1;
        }

        .carousel-caption p {
            font-size: clamp(1rem, 2vw, 1.4rem);
            font-weight: 400;
            color: var(--text-light);
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
        }

        .btn-hero {
            background: var(--blue-dark);
            color: var(--text-light);
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .btn-hero:hover {
            background: var(--blue-medium);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(29, 53, 87, 0.4);
            color: var(--text-light);
        }

        .btn-hero-outline {
            background: transparent;
            color: var(--text-light);
            border: 2px solid var(--text-light);
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-hero-outline:hover {
            background: var(--text-light);
            color: var(--blue-dark);
            transform: translateY(-3px);
        }

        /* Features Section */
        .features-section {
            padding: 6rem 0;
            background: var(--cream);
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            text-align: center;
            margin-bottom: 4rem;
            color: var(--blue-dark);
        }

        .feature-card {
            background: var(--text-light);
            border: 2px solid var(--blue-light);
            border-radius: 12px;
            padding: 3rem 2rem;
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(29, 53, 87, 0.1);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--blue-dark), var(--blue-medium));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--blue-medium);
            box-shadow: 0 20px 60px rgba(29, 53, 87, 0.2);
        }

        .feature-icon {
            font-size: 3.5rem;
            color: var(--blue-medium);
            margin-bottom: 1.5rem;
            display: block;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--blue-dark);
            margin-bottom: 1rem;
        }

        .feature-text {
            color: var(--text-gray);
            line-height: 1.8;
            font-size: 0.95rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-medium) 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(168, 218, 220, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .cta-text {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
        }

        .btn-cta {
            background: var(--text-light);
            color: var(--blue-dark);
            padding: 1rem 3rem;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            background: var(--blue-light);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: var(--blue-dark);
        }

        /* Footer */
        footer {
            background: var(--blue-dark);
            padding: 4rem 0 2rem;
            color: var(--text-light);
        }

        .footer-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border: 2px solid var(--blue-light);
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
            border-radius: 50%;
        }

        .social-link:hover {
            background: var(--blue-light);
            color: var(--blue-dark);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(168, 218, 220, 0.2);
            padding-top: 2rem;
            margin-top: 3rem;
            text-align: center;
            color: var(--blue-light);
        }

        .footer-link {
            color: var(--blue-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--text-light);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease both;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 70vh;
            }

            .carousel-caption {
                left: 5%;
                right: 5%;
                bottom: 20%;
            }

            .features-section {
                padding: 4rem 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('panel')}}">
                BAJO CERO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('panel')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tienda.index')}}">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tienda.index')}}?categoria=chaquetas">Chaquetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tienda.index')}}?categoria=gorras">Gorras</a>
                    </li>
                </ul>
                <form class="d-flex ms-3" action="{{route('login.index')}}" method="get">
                    <button class="btn btn-danger" type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('assets/img/img_carrusel_1.png')}}" class="d-block w-100" alt="Chaquetas Premium">
                <div class="carousel-caption">
                    <h1>Estilo que Define</h1>
                    <p>Descubre nuestra colección exclusiva de chaquetas y gorras con diseño urbano</p>
                    <div class="mt-4">
                        <a href="{{route('tienda.index')}}" class="btn btn-hero">Explorar Colección</a>
                        <a href="{{route('tienda.index')}}?categoria=chaquetas" class="btn btn-hero-outline">Ver Chaquetas</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/img_carrusel_2.png')}}" class="d-block w-100" alt="Nueva Colección">
                <div class="carousel-caption">
                    <h1>Nueva Colección 2025</h1>
                    <p>Tendencias urbanas que marcan la diferencia en cada prenda</p>
                    <div class="mt-4">
                        <a href="{{route('tienda.index')}}" class="btn btn-hero">Ver Novedades</a>
                        <a href="{{route('tienda.index')}}?categoria=gorras" class="btn btn-hero-outline">Ver Gorras</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/img_carrusel_3.png')}}" class="d-block w-100" alt="Calidad Premium">
                <div class="carousel-caption">
                    <h1>Calidad Premium</h1>
                    <p>Diseño, confort y durabilidad en cada prenda que usas</p>
                    <div class="mt-4">
                        <a href="{{route('tienda.index')}}" class="btn btn-hero">Explorar</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title fade-in">¿Por Qué Elegirnos?</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <i class="bi bi-star-fill feature-icon"></i>
                        <h4 class="feature-title">Diseño Exclusivo</h4>
                        <p class="feature-text">Chaquetas y gorras diseñadas con las últimas tendencias de moda urbana, combinando estilo único y funcionalidad en cada detalle.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <i class="bi bi-shield-check feature-icon"></i>
                        <h4 class="feature-title">Calidad Garantizada</h4>
                        <p class="feature-text">Materiales premium y procesos de fabricación cuidadosos que garantizan durabilidad y confort excepcional en cada prenda.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card fade-in">
                        <i class="bi bi-lightning-charge feature-icon"></i>
                        <h4 class="feature-title">Envío Rápido</h4>
                        <p class="feature-text">Recibe tus pedidos de forma rápida y segura. Envíos a todo el país con el mejor servicio de entrega disponible.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center">
                <h2 class="cta-title">Prepárate para el Estilo</h2>
                <p class="cta-text">Explora nuestra colección completa y encuentra la prenda perfecta que refleje tu personalidad urbana</p>
                <a href="{{route('tienda.index')}}" class="btn btn-cta">Ver Catálogo Completo</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="footer-title">BAJO CERO</h5>
                    <p style="color: var(--blue-light); line-height: 1.8;">Tu destino para chaquetas y gorras de última tendencia. Estilo urbano, calidad y diseño en cada prenda.</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="footer-title">Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{route('panel')}}" class="footer-link">Inicio</a></li>
                        <li class="mb-2"><a href="{{route('tienda.index')}}" class="footer-link">Tienda</a></li>
                        <li class="mb-2"><a href="{{route('tienda.index')}}?categoria=chaquetas" class="footer-link">Chaquetas</a></li>
                        <li class="mb-2"><a href="{{route('tienda.index')}}?categoria=gorras" class="footer-link">Gorras</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-title">Síguenos</h5>
                    <div>
                        <a href="#" class="social-link" target="_blank" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-link" target="_blank" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-link" target="_blank" aria-label="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; 2025 Bajo Cero. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bajo Cero - Streetwear Premium')</title>
    
    <!-- Google Fonts: Outfit (Titulos) & Rajdhani (Cuerpo Técnico) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            /* Paleta Midnight Urban (Default/Dark) */
            --bg-main: #0B0C10;
            --bg-surface: #1F2833;
            --text-main: #FFFFFF;
            --text-muted: #C5C6C7;
            --accent-neon: #66FCF1;
            --accent-dim: #45A29E;
            --border-color: rgba(102, 252, 241, 0.1);
            --glow: 0 0 15px rgba(102, 252, 241, 0.3);
            --glow-hover: 0 0 25px rgba(102, 252, 241, 0.6);
            --card-bg: #1F2833;
            --hero-overlay: linear-gradient(rgba(11, 12, 16, 0.7), rgba(11, 12, 16, 0.9));
            --nav-bg: rgba(11, 12, 16, 0.95);
            --footer-bg: #050608;
            --footer-text: #E0E0E0;     /* Texto claro para footer oscuro */
        }

        [data-theme="light"] {
            /* Paleta Cream Urban (Light) */
            --bg-main: #FDFBF7;         /* Crema Cálido */
            --bg-surface: #FFFFFF;      /* Blanco Puro */
            --text-main: #1A1A1A;       /* Negro Suave */
            --text-muted: #4A4A4A;      /* Gris Medio */
            --accent-neon: #006064;     /* Teal Profundo (Vibrante y Elegante) */
            --accent-dim: #00897B;      /* Teal Medio */
            --border-color: rgba(0, 96, 100, 0.2);
            --glow: 0 0 10px rgba(0, 96, 100, 0.1);
            --glow-hover: 0 0 15px rgba(0, 96, 100, 0.2);
            --card-bg: #FFFFFF;
            --hero-overlay: linear-gradient(rgba(253, 251, 247, 0.4), rgba(253, 251, 247, 0.6));
            --nav-bg: rgba(253, 251, 247, 0.95);
            --footer-bg: #F0EFEA;       /* Crema Oscuro para Footer */
            --footer-text: #4A4A4A;     /* Texto oscuro para footer claro */
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .btn-premium {
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Navbar Cyberpunk/Urban */
        .navbar {
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 1.2rem 0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-main) !important;
            text-shadow: 0 0 10px rgba(255,255,255,0.3);
        }

        .navbar-brand span {
            color: var(--accent-neon);
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-muted) !important;
            margin: 0 1rem;
            position: relative;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent-neon) !important;
            text-shadow: 0 0 8px var(--accent-neon);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-neon);
            transition: width 0.3s ease;
            box-shadow: 0 0 10px var(--accent-neon);
        }

        .nav-link:hover::before {
            width: 100%;
        }

        /* Botones Neon */
        .btn-primary {
            background-color: transparent;
            border: 2px solid var(--accent-neon);
            color: var(--accent-neon);
            padding: 0.6rem 2rem;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 0; /* Bordes rectos estilo urbano */
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: var(--accent-neon);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .btn-primary:hover {
            color: var(--bg-main);
            box-shadow: var(--glow-hover);
            border-color: var(--accent-neon);
        }

        .btn-primary:hover::before {
            width: 100%;
        }

        /* Badge Carrito */
        .badge-cart {
            background-color: var(--accent-neon);
            color: var(--bg-main);
            font-weight: 800;
            font-size: 0.8rem;
            padding: 0.25em 0.6em;
            border-radius: 2px;
            position: absolute;
            top: -5px;
            right: -10px;
            box-shadow: 0 0 10px var(--accent-neon);
        }

        /* Footer Dark */
        footer {
            background-color: var(--footer-bg);
            border-top: 1px solid var(--border-color);
            padding-top: 5rem;
            margin-top: auto;
            color: var(--footer-text);
        }

        footer .text-muted {
            color: var(--footer-text) !important;
        }

        .footer-title {
            color: var(--text-main);
            font-weight: 800;
            margin-bottom: 1.5rem;
            border-left: 3px solid var(--accent-neon);
            padding-left: 1rem;
        }

        .footer a {
            color: var(--footer-text);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            color: var(--accent-neon);
            padding-left: 10px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--text-muted);
            color: var(--text-muted);
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        /* Logo interactivo */
        .logo-container {
            position: relative;
            width: 250px;
            height: 250px;
        }
        .logo-container .logo-img {
            width: 100%;
            height: auto;
            display: block;
        }
        .eye {
            position: absolute;
            width: 30px;
            height: 30px;
            background: var(--accent-neon);
            border-radius: 50%;
            top: 30%;
            left: 30%;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease;
            box-shadow: 0 0 8px var(--accent-neon);
        }
        .left-eye { left: 35%; }
        /* Logo filter for theme */
        [data-theme="dark"] .logo-img {
            filter: invert(1) brightness(1.2);
        }
        [data-theme="light"] .logo-img {
            filter: none;
        }


        /* WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(37, 211, 102, 0.4);
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 0 30px rgba(37, 211, 102, 0.6);
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                BAJO<span style="color: var(--accent-neon);">CERO</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-1"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tienda.index') }}">COLECCIÓN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tienda.contact') }}">CONTACTO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tienda.about') }}">NOSOTROS</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Theme Toggle -->
                    <button id="themeToggle" class="btn btn-link text-white p-0 fs-5" title="Cambiar Tema">
                        <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                    </button>

                    <a href="{{ route('login.index') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 d-flex align-items-center gap-2" style="border-color: var(--accent-neon); color: var(--accent-neon);">
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-lg-inline">LOGIN</span>
                    </a>
                    <a href="{{ route('carrito.index') }}" class="position-relative text-white fs-5">
                        <i class="bi bi-bag" style="color: var(--text-main) !important;"></i>
                        @php
                            $carritoCount = 0;
                            if(session()->has('carrito')) {
                                foreach(session('carrito') as $item) {
                                    $carritoCount += $item['cantidad'];
                                }
                            }
                        @endphp
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $carritoCount }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contacto">
        <div class="container pb-5">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">BAJO CERO</h5>
                    <p class="text-muted">Redefiniendo el estilo urbano. Prendas diseñadas para quienes no temen destacar. Calidad premium, diseño exclusivo.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">EXPLORAR</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ url('/') }}">Inicio</a></li>
                        <li><a href="{{ route('tienda.index') }}">Catálogo</a></li>
                        <li><a href="{{ route('carrito.index') }}">Carrito</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">CONTACTO</h5>
                    <ul class="list-unstyled text-muted d-flex flex-column gap-3">
                        <li><i class="bi bi-geo-alt me-2 text-info"></i> Bogotá, Colombia</li>
                        <li><i class="bi bi-whatsapp me-2 text-info"></i> +57 300 123 4567</li>
                        <li><i class="bi bi-envelope me-2 text-info"></i> contacto@bajocero.com</li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">PAGOS SEGUROS</h5>
                    <p class="text-muted small mb-4">Procesamos tus pagos con la máxima seguridad.</p>
                    <div class="d-flex gap-3 fs-2 text-muted">
                        <i class="bi bi-credit-card"></i>
                        <i class="bi bi-cash-coin"></i>
                        <i class="bi bi-bank"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center py-4 border-top" style="border-color: rgba(255,255,255,0.05) !important;">
            <small class="text-muted">&copy; {{ date('Y') }} Bajo Cero. Todos los derechos reservados.</small>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/573001234567" class="whatsapp-float" target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Eye follow cursor
        document.addEventListener('mousemove', function(e) {
            const eyes = document.querySelectorAll('.eye');
            eyes.forEach(function(eye) {
                const rect = eye.getBoundingClientRect();
                const eyeX = rect.left + rect.width / 2;
                const eyeY = rect.top + rect.height / 2;
                const dx = e.clientX - eyeX;
                const dy = e.clientY - eyeY;
                const angle = Math.atan2(dy, dx);
                const radius = 8; // max movement radius
                const x = Math.cos(angle) * radius;
                const y = Math.sin(angle) * radius;
                eye.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
    @yield('scripts')
</body>
</html>

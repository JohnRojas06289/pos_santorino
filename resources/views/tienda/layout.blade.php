<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bajo Cero - Chaquetas y Gorras Premium')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
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
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(241, 250, 238, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--blue-light);
            padding: 1.2rem 0;
            box-shadow: 0 2px 20px rgba(29, 53, 87, 0.1);
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--blue-dark) !important;
            letter-spacing: -0.5px;
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

        .btn-primary {
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

        .btn-primary:hover {
            background: var(--blue-medium);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(29, 53, 87, 0.3);
            color: var(--text-light);
        }

        .btn-outline-light {
            border: 2px solid var(--blue-dark);
            color: var(--blue-dark);
            border-radius: 4px;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-light:hover {
            background: var(--blue-dark);
            color: var(--text-light);
            border-color: var(--blue-dark);
        }

        .cart-badge {
            background: var(--accent);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            position: absolute;
            top: -8px;
            right: -10px;
        }

        .cart-btn {
            position: relative;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('panel') }}">
                BAJO CERO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('tienda.index') }}">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tienda.index') }}?categoria=chaquetas">Chaquetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tienda.index') }}?categoria=gorras">Gorras</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('carrito.index') }}" class="btn btn-outline-light cart-btn position-relative">
                        <i class="bi bi-cart3"></i>
                        @php
                            $carrito = session()->get('carrito', []);
                            $totalItems = array_sum(array_column($carrito, 'cantidad'));
                        @endphp
                        @if($totalItems > 0)
                            <span class="cart-badge">{{ $totalItems }}</span>
                        @endif
                    </a>
                    <a href="{{ route('login.index') }}" class="btn btn-primary">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

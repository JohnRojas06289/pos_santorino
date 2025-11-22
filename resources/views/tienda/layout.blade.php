<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bajo Cero - Chaquetas Premium')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --ice-blue: #A8DADC;
            --deep-blue: #1D3557;
            --navy: #457B9D;
            --frost-white: #F1FAEE;
            --accent-red: #E63946;
        }
        * {
            font-family: 'Montserrat', sans-serif;
        }
        body {
            background: linear-gradient(135deg, var(--deep-blue) 0%, #2C4A66 100%);
            min-height: 100vh;
        }
        .navbar {
            background: rgba(29, 53, 87, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--ice-blue) !important;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .nav-link {
            color: var(--frost-white) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--ice-blue) !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-red), #C5303D);
            border: none;
            padding: 10px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(230, 57, 70, 0.6);
        }
        .cart-badge {
            background: var(--accent-red);
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            position: absolute;
            top: -5px;
            right: -10px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('panel') }}">
                ❄️ BAJO CERO
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
                        <a class="nav-link" href="{{ route('tienda.index') }}">Tienda</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('carrito.index') }}" class="btn btn-outline-light position-relative">
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
    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

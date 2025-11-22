<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Bajo Cero - Tu tienda especializada en chaquetas y ropa de invierno. Encuentra las mejores chaquetas para enfrentar el frío con estilo." />
    <meta name="author" content="Bajo Cero" />
    <title>Bajo Cero - Chaquetas Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
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

        .carousel-item img {
            height: 600px;
            object-fit: cover;
            filter: brightness(0.9);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(168, 218, 220, 0.2);
            border-radius: 15px;
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(168, 218, 220, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--ice-blue);
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--frost-white);
            margin-bottom: 50px;
            text-align: center;
        }

        .cta-section {
            background: linear-gradient(135deg, rgba(230, 57, 70, 0.9), rgba(197, 48, 61, 0.9));
            padding: 80px 0;
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        footer {
            background: rgba(29, 53, 87, 0.95);
            padding: 40px 0 20px;
        }
    </style>
</head>

<body>

    <!--Barra de navegación--->
    <nav class="navbar navbar-expand-md sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('panel')}}">
                ❄️ BAJO CERO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('panel')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tienda.index')}}">Tienda</a>
                    </li>
                </ul>

                <form class="d-flex" action="{{route('login.index')}}" method="get">
                    <button class="btn btn-primary" type="submit">Iniciar sesión</button>
                </form>

            </div>
        </div>
    </nav>

    <!--Carrusel--->
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('assets/img/img_carrusel_1.png')}}" class="d-block w-100" alt="Chaquetas Premium Bajo Cero">
                <div class="carousel-caption d-none d-md-block">
                    <h1 style="font-size: 3.5rem; font-weight: 700; text-shadow: 2px 2px 10px rgba(0,0,0,0.7);">Enfrenta el Frío con Estilo</h1>
                    <p style="font-size: 1.3rem; text-shadow: 1px 1px 5px rgba(0,0,0,0.7);">Chaquetas premium diseñadas para el invierno extremo</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/img_carrusel_2.png')}}" class="d-block w-100" alt="Colección Invierno">
                <div class="carousel-caption d-none d-md-block">
                    <h1 style="font-size: 3.5rem; font-weight: 700; text-shadow: 2px 2px 10px rgba(0,0,0,0.7);">Nueva Colección 2025</h1>
                    <p style="font-size: 1.3rem; text-shadow: 1px 1px 5px rgba(0,0,0,0.7);">Descubre los últimos diseños en chaquetas de invierno</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/img_carrusel_3.png')}}" class="d-block w-100" alt="Calidad Premium">
                <div class="carousel-caption d-none d-md-block">
                    <h1 style="font-size: 3.5rem; font-weight: 700; text-shadow: 2px 2px 10px rgba(0,0,0,0.7);">Calidad que Abriga</h1>
                    <p style="font-size: 1.3rem; text-shadow: 1px 1px 5px rgba(0,0,0,0.7);">Materiales de primera calidad para máxima protección</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="##carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--Section Características--->
    <div class="container-md py-5">
        <h2 class="section-title mt-5">¿Por Qué Elegir Bajo Cero?</h2>
        <div class="row my-4 g-4">
            <div class="col-lg-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">🧥</div>
                    <h4 style="color: var(--ice-blue); font-weight: 600;">Diseño Premium</h4>
                    <p style="color: var(--frost-white);">Chaquetas diseñadas con las últimas tendencias de moda invernal, combinando estilo y funcionalidad.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">❄️</div>
                    <h4 style="color: var(--ice-blue); font-weight: 600;">Máxima Protección</h4>
                    <p style="color: var(--frost-white);">Materiales térmicos de alta calidad que te protegen del frío extremo sin sacrificar comodidad.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">✨</div>
                    <h4 style="color: var(--ice-blue); font-weight: 600;">Durabilidad Garantizada</h4>
                    <p style="color: var(--frost-white);">Costuras reforzadas y materiales resistentes que garantizan años de uso en las condiciones más duras.</p>
                </div>
            </div>
        </div>
    </div>

    <!--Section CTA--->
    <section class="cta-section text-center">
        <div class="container p-5 position-relative" style="z-index: 1;">
            <h2 class="text-white mb-4" style="font-size: 3rem; font-weight: 700;">Prepárate para el Invierno</h2>
            <p class="text-white mb-5" style="font-size: 1.3rem;">Explora nuestra colección completa y encuentra la chaqueta perfecta para ti</p>
            <div>
                <a href="{{route('tienda.index')}}" role="button" class="btn btn-primary btn-lg">Ver Catálogo</a>
            </div>
        </div>
    </section>

    <!--Footer--->
    <footer class="text-center text-white">
        <div class="container p-4 pb-0">
            <section class="mb-4">
                <p style="color: var(--ice-blue); font-size: 1.1rem; font-weight: 600;">Síguenos en Redes Sociales</p>
                
                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg>
                </a>

                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </a>

                <!-- WhatsApp -->
                <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                </a>
            </section>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.3);">
            © 2025 Bajo Cero - Todos los derechos reservados
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
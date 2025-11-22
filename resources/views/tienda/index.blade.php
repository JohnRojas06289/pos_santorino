@extends('tienda.layout')

@section('title', 'Catálogo - Bajo Cero')

@section('styles')
<style>
    /* Header del Catálogo */
    .page-header {
        text-align: center;
        padding: 6rem 0 4rem;
        background: linear-gradient(to bottom, var(--bg-main), var(--bg-surface));
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 3rem;
        position: relative;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--accent-neon);
        box-shadow: var(--glow);
    }

    .page-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        color: var(--text-main);
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 1.2rem;
        font-family: 'Rajdhani', sans-serif;
    }

    /* Filtros */
    .filter-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        padding: 2rem;
        position: sticky;
        top: 100px;
    }

    .filter-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-title i {
        color: var(--accent-neon);
    }

    .form-label {
        color: var(--accent-neon);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-control,
    .form-select {
        background: var(--bg-main);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        border-radius: 0;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        background: var(--bg-main);
        border-color: var(--accent-neon);
        color: var(--text-main);
        box-shadow: var(--glow);
        outline: none;
    }

    .form-control::placeholder {
        color: var(--text-muted);
        opacity: 0.5;
    }

    /* Tarjetas de Producto */
    .product-card {
        background: var(--bg-surface);
        border: 1px solid transparent;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .product-card:hover {
        border-color: var(--accent-neon);
        transform: translateY(-5px);
        box-shadow: var(--glow-hover);
    }

    .product-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 350px;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.1);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(11, 12, 16, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-overlay {
        opacity: 0;
    }

    .product-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        border-top: 1px solid var(--border-color);
    }

    .product-title {
        color: var(--text-main);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .product-brand {
        color: var(--accent-dim);
        font-size: 0.85rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .product-price {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent-neon);
        margin-top: auto;
    }

    .badge-stock {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.8);
        color: var(--text-main);
        padding: 5px 10px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 1px solid var(--border-color);
        z-index: 2;
    }

    /* Botones */
    .btn-filter {
        background: var(--accent-neon);
        color: var(--bg-main);
        font-weight: 800;
        text-transform: uppercase;
        border: none;
        width: 100%;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: #fff;
        box-shadow: var(--glow);
    }

    .btn-view {
        background: transparent;
        border: 1px solid var(--accent-neon);
        color: var(--accent-neon);
        padding: 0.8rem 2rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        background: var(--accent-neon);
        color: var(--bg-main);
        box-shadow: var(--glow);
    }

    /* Botón Agregar en card */
    .btn-add-cart {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 0.8rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 5;
    }

    .btn-add-cart:hover {
        background: var(--accent-neon);
        border-color: var(--accent-neon);
        color: var(--bg-main);
        box-shadow: var(--glow);
    }

    /* Ocultar botón agregar en hover de la card */
    .product-card:hover .btn-add-cart {
        opacity: 1;
        pointer-events: auto;
    }

    /* Mostrar botón ver detalles en hover */
    .product-card .btn-view-bottom {
        opacity: 1;
        pointer-events: auto;
        transition: all 0.3s ease;
        position: relative;
        z-index: 10;
    }

    .product-card:hover .btn-view-bottom {
        opacity: 1;
        pointer-events: auto;
    }

    /* Card clickeable */
    .product-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .product-card-link:hover {
        color: inherit;
    }

    /* Asegurar que los botones sean clickeables sobre el link */
    .product-card form,
    .product-card button,
    .product-card .carousel-nav,
    .product-card .carousel-dot {
        position: relative;
        z-index: 10;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    /* Range Slider Custom */
    input[type=range] {
        accent-color: var(--accent-neon);
    }

    /* Carousel Styles */
    .product-carousel {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .carousel-images {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .carousel-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .carousel-image.active {
        opacity: 1;
        pointer-events: auto;
    }

    /* Carousel Navigation Arrows */
    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.9);
        border: 2px solid var(--accent-neon);
        color: var(--accent-neon);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 1 !important;
        transition: all 0.3s ease;
        z-index: 100 !important;
        backdrop-filter: blur(5px);
    }

    .carousel-nav:hover {
        background: var(--accent-neon);
        color: var(--bg-main);
        box-shadow: var(--glow);
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-nav.prev {
        left: 10px;
    }

    .carousel-nav.next {
        right: 10px;
    }

    .carousel-nav i {
        font-size: 1.2rem;
        font-weight: bold;
    }

    /* Carousel Dots Indicators */
    .carousel-dots {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .carousel-dots {
        opacity: 1;
    }

    .carousel-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.8);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-dot:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.2);
    }

    .carousel-dot.active {
        background: var(--accent-neon);
        border-color: var(--accent-neon);
        box-shadow: 0 0 8px var(--accent-neon);
    }

    /* Hide carousel controls if only one image */
    .product-carousel[data-count="1"] .carousel-nav,
    .product-carousel[data-count="1"] .carousel-dots {
        display: none;
    }

</style>
@endsection

@section('content')

<!-- Header -->
<header class="page-header">
    <div class="container-fluid px-4 px-lg-5">
        <h1 class="page-title">Nuestro Catálogo</h1>
        <p class="page-subtitle">Descubre las últimas tendencias en moda urbana</p>
    </div>
</header>

<div class="container-fluid px-4 px-lg-5 pb-5">
    <div class="row">
        <!-- Sidebar Filtros -->
        <aside class="col-lg-3 mb-5">
            <div class="filter-card">
                <h3 class="filter-title">
                    <i class="bi bi-sliders"></i> Filtros
                </h3>
                
                <form action="{{ route('tienda.index') }}" method="GET" id="filterForm">
                    <!-- Búsqueda -->
                    <div class="mb-4">
                        <label class="form-label"><i class="bi bi-search me-2"></i>Buscar</label>
                        <input type="text" name="buscar" class="form-control" 
                               placeholder="Nombre del producto..." 
                               value="{{ request('buscar') }}">
                    </div>

                    <!-- Categorías -->
                    <div class="mb-4">
                        <label class="form-label"><i class="bi bi-tags me-2"></i>Categoría</label>
                        <select name="categoria" class="form-select" onchange="this.form.submit()">
                            <option value="">Todas las categorías</option>
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marcas -->
                    <div class="mb-4">
                        <label class="form-label"><i class="bi bi-star me-2"></i>Marca</label>
                        <select name="marca" class="form-select" onchange="this.form.submit()">
                            <option value="">Todas las marcas</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Precio -->
                    <div class="mb-4">
                        <label class="form-label"><i class="bi bi-currency-dollar me-2"></i>Precio Máximo</label>
                        <input type="range" class="form-range" min="0" max="1000000" step="10000" 
                               name="precio_max" value="{{ request('precio_max', 1000000) }}"
                               oninput="document.getElementById('priceOutput').innerText = '$' + new Intl.NumberFormat('es-CO').format(this.value)">
                        <div class="text-end text-muted" id="priceOutput">
                            ${{ number_format(request('precio_max', 1000000), 0, ',', '.') }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-filter mb-3">
                        Aplicar Filtros
                    </button>
                    
                    @if(request()->anyFilled(['buscar', 'categoria', 'marca', 'precio_max']))
                        <a href="{{ route('tienda.index') }}" class="btn btn-outline-light w-100 text-uppercase fw-bold" style="border-radius: 0;">
                            Limpiar Filtros
                        </a>
                    @endif
                </form>
            </div>
        </aside>

        <!-- Grid de Productos -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 text-muted">
                <small><i class="bi bi-grid-3x3-gap me-2"></i>Mostrando {{ $productos->count() }} productos</small>
            </div>

            @if($productos->count() > 0)
                <div class="row g-4">
                    @foreach($productos as $producto)
                        <div class="col-md-6 col-lg-3">
                            <div class="product-card">
                                <div class="badge-stock">
                                    @if($producto->stock_real > 0)
                                        <span class="text-success"><i class="bi bi-check-circle me-1"></i>Disponible</span>
                                    @else
                                        <span class="text-danger"><i class="bi bi-x-circle me-1"></i>Agotado</span>
                                    @endif
                                </div>
                                
                                <div class="product-img-wrapper">
                                    @php
                                        // Recopilar todas las imágenes del producto
                                        $imagenes = [];
                                        
                                        // Agregar imagen principal si existe
                                        if ($producto->img_path) {
                                            $imagenes[] = [
                                                'url' => asset($producto->img_path),
                                                'alt' => $producto->nombre
                                            ];
                                        }
                                        
                                        // Agregar imágenes multimedia (solo imágenes, no videos)
                                        if ($producto->multimedia) {
                                            foreach ($producto->multimedia->where('tipo', 'imagen') as $media) {
                                                $imagenes[] = [
                                                    'url' => asset($media->ruta),
                                                    'alt' => $producto->nombre . ' - Imagen adicional'
                                                ];
                                            }
                                        }
                                        
                                        // Si no hay imágenes, usar placeholder
                                        if (empty($imagenes)) {
                                            $imagenes[] = [
                                                'url' => 'https://via.placeholder.com/400x400/1F2833/66FCF1?text=BAJO+CERO',
                                                'alt' => 'Sin imagen'
                                            ];
                                        }
                                        
                                        $totalImagenes = count($imagenes);
                                    @endphp

                                    <a href="{{ route('tienda.show', $producto->id) }}">
                                        <div class="product-carousel" data-count="{{ $totalImagenes }}" data-product-id="{{ $producto->id }}">
                                            <div class="carousel-images">
                                                @foreach($imagenes as $index => $imagen)
                                                    <img src="{{ $imagen['url'] }}" 
                                                         class="product-img carousel-image {{ $index === 0 ? 'active' : '' }}" 
                                                         alt="{{ $imagen['alt'] }}" 
                                                         onerror="this.src='https://via.placeholder.com/400x400/1F2833/66FCF1?text=BAJO+CERO'"
                                                         data-index="{{ $index }}">
                                                @endforeach
                                            </div>

                                            <!-- Dots Indicators -->
                                            @if($totalImagenes > 1)
                                                <div class="carousel-dots" data-product-id="{{ $producto->id }}">
                                                    @for($i = 0; $i < $totalImagenes; $i++)
                                                        <div class="carousel-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                    
                                    <!-- Navigation Arrows OUTSIDE the link but INSIDE img-wrapper -->
                                    @if($totalImagenes > 1)
                                        <div class="carousel-nav prev" data-product-id="{{ $producto->id }}" onclick="event.stopPropagation();">
                                            <i class="bi bi-chevron-left"></i>
                                        </div>
                                        <div class="carousel-nav next" data-product-id="{{ $producto->id }}" onclick="event.stopPropagation();">
                                            <i class="bi bi-chevron-right"></i>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('tienda.show', $producto->id) }}" style="text-decoration: none; color: inherit;">
                                    <div class="product-body">
                                        <div class="product-brand">{{ $producto->marca->nombre ?? 'BAJO CERO' }}</div>
                                        <h5 class="product-title">{{ $producto->nombre }}</h5>
                                        <div class="product-price">
                                            ${{ number_format($producto->precio, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </a>
                                
                                @if($producto->stock_real > 0)
                                    <div class="px-3 pb-3" style="margin-top: -1rem !important;">
                                        <a href="{{ route('tienda.show', $producto->id) }}" class="btn btn-view btn-view-bottom w-100 rounded-0 text-uppercase fw-bold">
                                            VER DETALLES
                                        </a>
                                    </div>
                                @else
                                    <div class="px-3 pb-3" style="margin-top: -1rem !important;">
                                        <button class="btn btn-secondary w-100 rounded-0 text-uppercase fw-bold" disabled>
                                            Agotado
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-5 d-flex justify-content-center">
                    {{-- Paginación si fuera necesaria --}}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-search empty-icon"></i>
                    <h3 class="text-white mb-3">No se encontraron productos</h3>
                    <p class="text-muted mb-4">Intenta ajustar tus filtros de búsqueda para encontrar lo que buscas.</p>
                    <a href="{{ route('tienda.index') }}" class="btn btn-primary">
                        Ver Todo el Catálogo
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de Reserva -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: var(--bg-surface); border: 1px solid var(--border-color);">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                <h5 class="modal-title text-white" id="reserveModalLabel">
                    <i class="bi bi-bookmark-check text-info"></i> Reservar Producto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info bg-dark border-info text-info">
                    <i class="bi bi-info-circle"></i> 
                    <strong>Producto:</strong> <span id="modalProductName"></span><br>
                    <strong>Precio:</strong> $<span id="modalProductPrice"></span>
                </div>
                <form id="reserveForm">
                    <div class="mb-3">
                        <label for="reserveName" class="form-label text-white">
                            <i class="bi bi-person"></i> Nombre Completo *
                        </label>
                        <input type="text" class="form-control" id="reserveName" required placeholder="Tu nombre completo">
                    </div>
                    <div class="mb-3">
                        <label for="reservePhone" class="form-label text-white">
                            <i class="bi bi-telephone"></i> Teléfono / WhatsApp *
                        </label>
                        <input type="tel" class="form-control" id="reservePhone" required placeholder="321 2335821">
                    </div>
                    <div class="mb-3">
                        <label for="reserveEmail" class="form-label text-white">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control" id="reserveEmail" placeholder="tu@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="reserveComments" class="form-label text-white">
                            <i class="bi bi-chat-text"></i> Comentarios Adicionales
                        </label>
                        <textarea class="form-control" id="reserveComments" rows="3" placeholder="Talla, color preferido, fecha de recogida, etc."></textarea>
                    </div>
                    <div class="alert alert-warning bg-dark border-warning text-warning">
                        <i class="bi bi-exclamation-triangle"></i> 
                        <small>Al reservar, nos pondremos en contacto contigo por WhatsApp para confirmar tu pedido.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmReserve">
                    <i class="bi bi-whatsapp"></i> Confirmar Reserva
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animaciones simples al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.product-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Inicializar carruseles de imágenes
        initializeCarousels();
    });

    function initializeCarousels() {
        const carousels = document.querySelectorAll('.product-carousel');
        
        carousels.forEach(carousel => {
            const productId = carousel.dataset.productId;
            const images = carousel.querySelectorAll('.carousel-image');
            const dots = carousel.querySelectorAll('.carousel-dot');
            const prevBtn = carousel.querySelector('.carousel-nav.prev');
            const nextBtn = carousel.querySelector('.carousel-nav.next');
            
            let currentIndex = 0;
            const totalImages = images.length;

            // Solo configurar si hay más de una imagen
            if (totalImages <= 1) return;

            // Función para cambiar imagen
            function goToImage(index) {
                // Remover clase active de imagen y dot actual
                images[currentIndex].classList.remove('active');
                dots[currentIndex].classList.remove('active');
                
                // Actualizar índice
                currentIndex = index;
                if (currentIndex < 0) currentIndex = totalImages - 1;
                if (currentIndex >= totalImages) currentIndex = 0;
                
                // Agregar clase active a nueva imagen y dot
                images[currentIndex].classList.add('active');
                dots[currentIndex].classList.add('active');
            }

            // Event listeners para flechas
            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    goToImage(currentIndex - 1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    goToImage(currentIndex + 1);
                });
            }

            // Event listeners para dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    goToImage(index);
                });
            });
        });
    }

    // Manejar modal de reserva
    const reserveModal = document.getElementById('reserveModal');
    let currentProductData = {};

    if (reserveModal) {
        reserveModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            currentProductData = {
                id: button.getAttribute('data-product-id'),
                name: button.getAttribute('data-product-name'),
                price: button.getAttribute('data-product-price')
            };

            // Actualizar información del producto en el modal
            document.getElementById('modalProductName').textContent = currentProductData.name;
            document.getElementById('modalProductPrice').textContent = currentProductData.price;

            // Limpiar formulario
            document.getElementById('reserveForm').reset();
        });

        // Confirmar reserva y enviar por WhatsApp
        document.getElementById('confirmReserve').addEventListener('click', function() {
            const form = document.getElementById('reserveForm');
            
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const name = document.getElementById('reserveName').value;
            const phone = document.getElementById('reservePhone').value;
            const email = document.getElementById('reserveEmail').value;
            const comments = document.getElementById('reserveComments').value;

            // Construir mensaje de WhatsApp
            let message = `🛍️ *RESERVA DE PRODUCTO*\n\n`;
            message += `📦 *Producto:* ${currentProductData.name}\n`;
            message += `💰 *Precio:* $${currentProductData.price}\n\n`;
            message += `👤 *Cliente:* ${name}\n`;
            message += `📱 *Teléfono:* ${phone}\n`;
            if (email) {
                message += `📧 *Email:* ${email}\n`;
            }
            if (comments) {
                message += `\n💬 *Comentarios:*\n${comments}`;
            }

            // Número de WhatsApp de la tienda
            const whatsappNumber = '573001234567';
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;

            // Abrir WhatsApp
            window.open(whatsappUrl, '_blank');

            // Cerrar modal
            const modalInstance = bootstrap.Modal.getInstance(reserveModal);
            modalInstance.hide();
        });
    }
</script>
@endsection

@extends('tienda.layout')

@section('title', $producto->nombre . ' - Bajo Cero')

@section('styles')
<style>
    .product-detail {
        padding: 3rem 0;
    }

    .breadcrumb-custom {
        background: transparent;
        padding: 0;
        margin-bottom: 2rem;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--blue-medium);
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: var(--blue-dark);
    }

    .product-gallery {
        position: relative;
        background: var(--text-light);
        border-radius: 12px;
        padding: 1rem;
        border: 2px solid var(--blue-light);
    }

    .main-image {
        width: 100%;
        height: 600px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
        background: var(--cream);
    }

    .main-image:hover {
        transform: scale(1.02);
    }

    .thumbnail-container {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 2px solid var(--blue-light);
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--cream);
    }

    .thumbnail:hover,
    .thumbnail.active {
        border-color: var(--blue-medium);
        transform: scale(1.1);
    }

    .product-info {
        padding-left: 2rem;
        background: var(--text-light);
        border-radius: 12px;
        padding: 2rem;
        border: 2px solid var(--blue-light);
    }

    .product-name {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .product-meta {
        color: var(--blue-medium);
        font-size: 0.95rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--blue-light);
    }

    .product-meta strong {
        color: var(--blue-dark);
    }

    .product-price {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 3rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 2rem;
    }

    .product-description {
        color: var(--text-gray);
        line-height: 1.8;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .product-description h5 {
        color: var(--blue-dark);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .product-actions {
        margin-bottom: 2rem;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .quantity-input {
        width: 100px;
        background: var(--cream);
        border: 2px solid var(--blue-light);
        color: var(--text-dark);
        padding: 0.75rem;
        text-align: center;
        border-radius: 6px;
        font-weight: 600;
    }

    .quantity-input:focus {
        border-color: var(--blue-medium);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
    }

    .btn-add-to-cart {
        background: var(--blue-dark);
        border: none;
        color: var(--text-light);
        padding: 1rem 2.5rem;
        font-weight: 600;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 6px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-add-to-cart:hover {
        background: var(--blue-medium);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(29, 53, 87, 0.4);
        color: var(--text-light);
    }

    .btn-back {
        background: transparent;
        border: 2px solid var(--blue-dark);
        color: var(--blue-dark);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: var(--blue-dark);
        color: var(--text-light);
        border-color: var(--blue-dark);
    }

    .related-section {
        margin-top: 5rem;
        padding-top: 3rem;
        border-top: 3px solid var(--blue-light);
    }

    .related-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 2rem;
    }

    .related-product-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 4px 15px rgba(29, 53, 87, 0.1);
    }

    .related-product-card:hover {
        transform: translateY(-5px);
        border-color: var(--blue-medium);
        box-shadow: 0 10px 30px rgba(29, 53, 87, 0.2);
    }

    .related-product-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        background: var(--cream);
    }

    .related-product-body {
        padding: 1.5rem;
    }

    .related-product-name {
        color: var(--blue-dark);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .related-product-price {
        color: var(--blue-dark);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        font-family: 'Space Grotesk', sans-serif;
    }

    .badge-large {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 6px;
    }

    .info-box {
        background: var(--cream);
        border: 2px solid var(--blue-light);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-box h5 {
        color: var(--blue-dark);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .product-info {
            padding-left: 0;
            margin-top: 2rem;
        }

        .main-image {
            height: 400px;
        }
    }

    /* Custom Video Player */
    .video-container {
        position: relative;
        width: 100%;
        height: 600px;
        background: #000;
        border-radius: 8px;
        overflow: hidden;
    }

    .video-container video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        opacity: 0;
        pointer-events: none;
        backdrop-filter: blur(10px);
    }

    .video-container:hover .video-play-button {
        opacity: 1;
        pointer-events: auto;
    }

    .video-play-button:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.8);
        transform: translate(-50%, -50%) scale(1.05);
    }

    .video-play-button i {
        font-size: 1.8rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .video-play-button:hover i {
        color: #ffffff;
    }

    .video-play-button.playing {
        opacity: 0;
        pointer-events: none;
    }

    .video-container:hover .video-play-button.playing {
        opacity: 1;
        pointer-events: auto;
    }

    /* Volume Control */
    .video-volume-control {
        position: absolute;
        bottom: 20px;
        right: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.15);
        padding: 10px 15px;
        border-radius: 25px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        z-index: 10;
        backdrop-filter: blur(10px);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .video-container:hover .video-volume-control {
        opacity: 1;
        pointer-events: auto;
    }

    .video-volume-control i {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
    }

    .volume-slider {
        width: 100px;
        height: 4px;
        -webkit-appearance: none;
        appearance: none;
        background: rgba(255, 255, 255, 0.3);
        outline: none;
        border-radius: 2px;
    }

    .volume-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 14px;
        height: 14px;
        background: rgba(255, 255, 255, 0.9);
        cursor: pointer;
        border-radius: 50%;
    }

    .volume-slider::-moz-range-thumb {
        width: 14px;
        height: 14px;
        background: rgba(255, 255, 255, 0.9);
        cursor: pointer;
        border-radius: 50%;
        border: none;
    }

    /* Video Progress Bar */
    .video-progress-control {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.15);
        padding: 10px 15px;
        border-radius: 25px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        z-index: 10;
        backdrop-filter: blur(10px);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .video-container:hover .video-progress-control {
        opacity: 1;
        pointer-events: auto;
    }

    .video-time-display {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.85rem;
        font-weight: 500;
        min-width: 90px;
        text-align: center;
        font-family: monospace;
    }

    .progress-slider {
        flex: 1;
        height: 4px;
        -webkit-appearance: none;
        appearance: none;
        background: rgba(255, 255, 255, 0.3);
        outline: none;
        border-radius: 2px;
        cursor: pointer;
    }

    .progress-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 14px;
        height: 14px;
        background: rgba(255, 255, 255, 0.9);
        cursor: pointer;
        border-radius: 50%;
    }

    .progress-slider::-moz-range-thumb {
        width: 14px;
        height: 14px;
        background: rgba(255, 255, 255, 0.9);
        cursor: pointer;
        border-radius: 50%;
        border: none;
    }

    /* Adjust volume control position when progress bar is present */
    .video-volume-control {
        bottom: 70px;
    }

    @media (max-width: 768px) {
        .video-container {
            height: 400px;
        }
        
        .volume-slider {
            width: 80px;
        }
    }
</style>
@endsection

@section('content')
<div class="product-detail">
    <div class="container-fluid px-4 px-lg-5">
        <nav aria-label="breadcrumb" class="breadcrumb-custom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tienda.index') }}">Tienda</a></li>
                <li class="breadcrumb-item active">{{ $producto->nombre }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Galería de Imágenes -->
            <div class="col-lg-6 mb-4">
                <div class="product-gallery">
                    @if($producto->multimedia->count() > 0)
                        <div id="productCarousel" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/600x600?text=Sin+Imagen' }}" 
                                         class="d-block w-100 main-image" 
                                         alt="{{ $producto->nombre }}">
                                </div>
                                
                                @foreach($producto->multimedia as $media)
                                    <div class="carousel-item">
                                        @if($media->tipo == 'imagen')
                                            <img src="{{ asset($media->ruta) }}" 
                                                 class="d-block w-100 main-image" 
                                                 alt="Imagen extra">
                                        @else
                                            <div class="video-container">
                                                <video class="product-video" 
                                                       data-video-id="{{ $media->id }}"
                                                       style="background: #000;">
                                                    <source src="{{ asset($media->ruta) }}" type="video/mp4">
                                                </video>
                                                <div class="video-play-button" data-video-id="{{ $media->id }}">
                                                    <i class="bi bi-play-fill"></i>
                                                </div>
                                                <div class="video-volume-control">
                                                    <i class="bi bi-volume-up-fill"></i>
                                                    <input type="range" 
                                                           class="volume-slider" 
                                                           data-video-id="{{ $media->id }}"
                                                           min="0" 
                                                           max="100" 
                                                           value="10">
                                                </div>
                                                <div class="video-progress-control">
                                                    <span class="video-time-display" data-video-id="{{ $media->id }}">
                                                        0:00 / 0:00
                                                    </span>
                                                    <input type="range" 
                                                           class="progress-slider" 
                                                           data-video-id="{{ $media->id }}"
                                                           min="0" 
                                                           max="100" 
                                                           value="0">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        </div>
                        
                        <div class="thumbnail-container">
                            <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/100' }}" 
                                 class="thumbnail active" 
                                 data-slide-to="0">
                            @foreach($producto->multimedia as $index => $media)
                                @if($media->tipo == 'imagen')
                                    <img src="{{ asset($media->ruta) }}" 
                                         class="thumbnail" 
                                         data-slide-to="{{ $index + 1 }}">
                                @else
                                    <img src="https://via.placeholder.com/100/000000/66FCF1?text=VIDEO" 
                                         class="thumbnail" 
                                         data-slide-to="{{ $index + 1 }}">
                                @endif
                            @endforeach
                        </div>
                    @else
                        <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/600x600?text=Sin+Imagen' }}" 
                             alt="{{ $producto->nombre }}" 
                             class="main-image">
                    @endif
                </div>
            </div>

            <!-- Información del Producto -->
            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="product-name">{{ $producto->nombre }}</h1>
                    <div class="product-meta">
                        <strong>Marca:</strong> {{ $producto->marca ? $producto->marca->caracteristica->nombre : 'Sin marca' }} |
                        <strong>Categoría:</strong> {{ $producto->categoria ? $producto->categoria->caracteristica->nombre : 'Sin categoría' }}
                    </div>
                    
                    <div class="product-price">${{ number_format($producto->precio, 0, ',', '.') }}</div>
                    
                    @if($producto->descripcion)
                        <div class="product-description">
                            <h5>Descripción</h5>
                            <p>{{ $producto->descripcion }}</p>
                        </div>
                    @endif

                    <div class="info-box">
                        <h5>
                            <i class="bi bi-box-seam"></i> Disponibilidad
                        </h5>
                        @if($producto->tieneStock())
                            <span class="badge badge-success badge-large">
                                <i class="bi bi-check-circle"></i> En Stock ({{ $producto->stock_real }} unidades disponibles)
                            </span>
                        @else
                            <span class="badge badge-danger badge-large">
                                <i class="bi bi-x-circle"></i> Agotado
                            </span>
                        @endif
                    </div>

                    @if($producto->tieneStock())
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="product-actions">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <div class="quantity-selector">
                                <label for="cantidad" style="color: var(--blue-dark); font-weight: 600;">
                                    <i class="bi bi-123"></i> Cantidad:
                                </label>
                                <input type="number" 
                                       name="cantidad" 
                                       id="cantidad" 
                                       class="quantity-input" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $producto->stock_real }}">
                                <small class="text-muted">(Máx: {{ $producto->stock_real }})</small>
                            </div>
                            <button type="submit" class="btn btn-add-to-cart">
                                <i class="bi bi-cart-plus"></i> Agregar al Carrito
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('tienda.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left"></i> Volver al Catálogo
                    </a>
                </div>
            </div>
        </div>

        <!-- Productos Relacionados -->
        @if($relacionados->count() > 0)
            <div class="related-section">
                <h3 class="related-title">
                    <i class="bi bi-grid"></i> Productos Relacionados
                </h3>
                <div class="row g-4">
                    @foreach($relacionados as $rel)
                        <div class="col-md-3 col-sm-6">
                            <div class="related-product-card">
                                <a href="{{ route('tienda.show', $rel->id) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ $rel->img_path ? asset($rel->img_path) : 'https://via.placeholder.com/300x200' }}" 
                                         class="related-product-img" 
                                         alt="{{ $rel->nombre }}">
                                </a>
                                <div class="related-product-body">
                                    <a href="{{ route('tienda.show', $rel->id) }}" style="text-decoration: none; color: inherit;">
                                        <h6 class="related-product-name">{{ $rel->nombre }}</h6>
                                    </a>
                                    <div class="related-product-price">${{ number_format($rel->precio, 0, ',', '.') }}</div>
                                    <a href="{{ route('tienda.show', $rel->id) }}" class="btn btn-outline-light w-100">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Actualizar thumbnail activo
    document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
        thumb.addEventListener('click', function() {
            const slideIndex = parseInt(this.getAttribute('data-slide-to'));
            const carousel = bootstrap.Carousel.getInstance(document.querySelector('#productCarousel'));
            if (carousel) {
                carousel.to(slideIndex);
            }
            
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Actualizar thumbnail cuando cambia el carousel
    const carousel = document.querySelector('#productCarousel');
    if (carousel) {
        carousel.addEventListener('slid.bs.carousel', function (e) {
            const activeIndex = Array.from(this.querySelectorAll('.carousel-item')).indexOf(e.relatedTarget);
            document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
                thumb.classList.toggle('active', index === activeIndex);
            });
            
            // Pausar todos los videos cuando se cambia de slide
            document.querySelectorAll('.product-video').forEach(video => {
                video.pause();
                const button = document.querySelector(`.video-play-button[data-video-id="${video.dataset.videoId}"]`);
                if (button) {
                    button.classList.remove('playing');
                    button.querySelector('i').classList.remove('bi-pause-fill');
                    button.querySelector('i').classList.add('bi-play-fill');
                }
            });
        });
    }

    // Custom video player controls
    document.querySelectorAll('.video-play-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const videoId = this.dataset.videoId;
            const video = document.querySelector(`.product-video[data-video-id="${videoId}"]`);
            const icon = this.querySelector('i');
            
            if (video.paused) {
                // Set volume to 10% on first play
                if (video.currentTime === 0) {
                    video.volume = 0.1;
                }
                video.play();
                icon.classList.remove('bi-play-fill');
                icon.classList.add('bi-pause-fill');
                this.classList.add('playing');
            } else {
                video.pause();
                icon.classList.remove('bi-pause-fill');
                icon.classList.add('bi-play-fill');
                this.classList.remove('playing');
            }
        });
    });

    // Volume control
    document.querySelectorAll('.volume-slider').forEach(slider => {
        slider.addEventListener('input', function(e) {
            const videoId = this.dataset.videoId;
            const video = document.querySelector(`.product-video[data-video-id="${videoId}"]`);
            if (video) {
                video.volume = this.value / 100;
            }
        });
    });

    // Progress bar control
    document.querySelectorAll('.progress-slider').forEach(slider => {
        slider.addEventListener('input', function(e) {
            const videoId = this.dataset.videoId;
            const video = document.querySelector(`.product-video[data-video-id="${videoId}"]`);
            if (video && video.duration) {
                const time = (this.value / 100) * video.duration;
                video.currentTime = time;
            }
        });
    });

    // Update progress bar and time display
    document.querySelectorAll('.product-video').forEach(video => {
        video.addEventListener('loadedmetadata', function() {
            const videoId = this.dataset.videoId;
            updateTimeDisplay(videoId, 0, this.duration);
        });

        video.addEventListener('timeupdate', function() {
            const videoId = this.dataset.videoId;
            const progressSlider = document.querySelector(`.progress-slider[data-video-id="${videoId}"]`);
            
            if (progressSlider && this.duration) {
                const progress = (this.currentTime / this.duration) * 100;
                progressSlider.value = progress;
                updateTimeDisplay(videoId, this.currentTime, this.duration);
            }
        });
    });

    // Helper function to format time
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    // Helper function to update time display
    function updateTimeDisplay(videoId, currentTime, duration) {
        const timeDisplay = document.querySelector(`.video-time-display[data-video-id="${videoId}"]`);
        if (timeDisplay) {
            timeDisplay.textContent = `${formatTime(currentTime)} / ${formatTime(duration)}`;
        }
    }

    // Show play button when video ends
    document.querySelectorAll('.product-video').forEach(video => {
        video.addEventListener('ended', function() {
            const button = document.querySelector(`.video-play-button[data-video-id="${this.dataset.videoId}"]`);
            if (button) {
                button.classList.remove('playing');
                button.querySelector('i').classList.remove('bi-pause-fill');
                button.querySelector('i').classList.add('bi-play-fill');
            }
            
            // Auto-advance to next slide when video ends
            const carousel = bootstrap.Carousel.getInstance(document.querySelector('#productCarousel'));
            if (carousel) {
                carousel.next();
            }
        });
    });
</script>
@endsection

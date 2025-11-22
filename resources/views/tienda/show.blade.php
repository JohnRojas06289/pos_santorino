@extends('tienda.layout')

@section('title', $producto->nombre . ' - Bajo Cero')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mb-4">
            @if($producto->multimedia->count() > 0)
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        {{-- Main Image --}}
                        <div class="carousel-item active">
                            <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/600x600?text=Sin+Imagen' }}" 
                                 class="d-block w-100" 
                                 alt="{{ $producto->nombre }}"
                                 style="height: 500px; object-fit: cover;">
                        </div>
                        
                        {{-- Multimedia Items --}}
                        @foreach($producto->multimedia as $media)
                            <div class="carousel-item">
                                @if($media->tipo == 'imagen')
                                    <img src="{{ asset($media->ruta) }}" 
                                         class="d-block w-100" 
                                         alt="Imagen extra"
                                         style="height: 500px; object-fit: cover;">
                                @else
                                    <video src="{{ asset($media->ruta) }}" 
                                           class="d-block w-100" 
                                           controls 
                                           style="height: 500px; object-fit: cover; background: #000;"></video>
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
                    
                    {{-- Thumbnails (Optional, simple version) --}}
                    <div class="row mt-2 g-2">
                        <div class="col-3">
                            <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/100' }}" 
                                 class="img-thumbnail" 
                                 style="cursor:pointer; height:80px; width:100%; object-fit:cover;"
                                 onclick="$('#productCarousel').carousel(0)">
                        </div>
                        @foreach($producto->multimedia as $index => $media)
                            <div class="col-3">
                                @if($media->tipo == 'imagen')
                                    <img src="{{ asset($media->ruta) }}" 
                                         class="img-thumbnail" 
                                         style="cursor:pointer; height:80px; width:100%; object-fit:cover;"
                                         onclick="$('#productCarousel').carousel({{ $index + 1 }})">
                                @else
                                    <div class="bg-dark d-flex align-items-center justify-content-center text-white img-thumbnail"
                                         style="cursor:pointer; height:80px; width:100%;"
                                         onclick="$('#productCarousel').carousel({{ $index + 1 }})">
                                        <i class="bi bi-play-circle fs-3"></i>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/600x600?text=Sin+Imagen' }}" 
                     alt="{{ $producto->nombre }}" 
                     class="img-fluid rounded" 
                     style="width: 100%; max-height: 600px; object-fit: cover;">
            @endif
        </div>
        <div class="col-lg-6">
            <h1 class="text-white fw-bold mb-3">{{ $producto->nombre }}</h1>
            <p class="text-white-50 mb-4">
                <strong>Marca:</strong> {{ $producto->marca ? $producto->marca->caracteristica->nombre : 'Sin marca' }} |
                <strong>Categoría:</strong> {{ $producto->categoria ? $producto->categoria->caracteristica->nombre : 'Sin categoría' }}
            </p>
            
            <h2 class="text-info fw-bold mb-4">${{ number_format($producto->precio, 0, ',', '.') }}</h2>
            
            @if($producto->descripcion)
                <div class="mb-4">
                    <h5 class="text-white">Descripción</h5>
                    <p class="text-white-50">{{ $producto->descripcion }}</p>
                </div>
            @endif

            <div class="mb-4">
                <h5 class="text-white">Disponibilidad</h5>
                @if($producto->inventario && $producto->inventario->stock > 0)
                    <span class="badge bg-success fs-6">En Stock ({{ $producto->inventario->stock }} unidades)</span>
                @else
                    <span class="badge bg-danger fs-6">Agotado</span>
                @endif
            </div>

            @if($producto->inventario && $producto->inventario->stock > 0)
                <form action="{{ route('carrito.agregar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    <div class="mb-4">
                        <label class="form-label text-white">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" value="1" min="1" max="{{ $producto->inventario->stock }}" style="max-width: 150px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                    </button>
                </form>
            @endif

            <a href="{{ route('tienda.index') }}" class="btn btn-outline-light mt-3">
                <i class="bi bi-arrow-left"></i> Volver al Catálogo
            </a>
        </div>
    </div>

    @if($relacionados->count() > 0)
        <div class="mt-5">
            <h3 class="text-white fw-bold mb-4">Productos Relacionados</h3>
            <div class="row g-4">
                @foreach($relacionados as $rel)
                    <div class="col-md-3">
                        <div class="card bg-dark text-white h-100">
                            <img src="{{ $rel->img_path ? asset($rel->img_path) : 'https://via.placeholder.com/300x200' }}" 
                                 class="card-img-top" alt="{{ $rel->nombre }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">{{ $rel->nombre }}</h6>
                                <p class="text-info fw-bold">${{ number_format($rel->precio, 0, ',', '.') }}</p>
                                <a href="{{ route('tienda.show', $rel->id) }}" class="btn btn-sm btn-outline-light">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

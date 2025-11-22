@extends('tienda.layout')

@section('title', 'Catálogo - Bajo Cero')

@section('styles')
<style>
    .product-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(168, 218, 220, 0.2);
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(168, 218, 220, 0.3);
    }
    .product-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    .product-title {
        color: var(--frost-white);
        font-weight: 600;
        font-size: 1.1rem;
    }
    .product-price {
        color: var(--ice-blue);
        font-size: 1.5rem;
        font-weight: 700;
    }
    .filter-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(168, 218, 220, 0.2);
        border-radius: 15px;
        padding: 20px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="text-center mb-5" style="color: var(--frost-white); font-weight: 700; font-size: 3rem;">
        Catálogo de Chaquetas
    </h1>

    <div class="row">
        <!-- Filtros -->
        <div class="col-lg-3 mb-4">
            <div class="filter-card">
                <h5 style="color: var(--ice-blue); font-weight: 600;">Filtros</h5>
                <form action="{{ route('tienda.index') }}" method="GET">
                    <!-- Búsqueda -->
                    <div class="mb-3">
                        <label class="form-label text-white">Buscar</label>
                        <input type="text" name="buscar" class="form-control" placeholder="Nombre del producto" value="{{ request('buscar') }}">
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label class="form-label text-white">Categoría</label>
                        <select name="categoria" class="form-select">
                            <option value="">Todas</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->caracteristica->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <label class="form-label text-white">Marca</label>
                        <select name="marca" class="form-select">
                            <option value="">Todas</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->caracteristica->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label class="form-label text-white">Precio Mínimo</label>
                        <input type="number" name="precio_min" class="form-control" placeholder="$0" value="{{ request('precio_min') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Precio Máximo</label>
                        <input type="number" name="precio_max" class="form-control" placeholder="$1000" value="{{ request('precio_max') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
                    <a href="{{ route('tienda.index') }}" class="btn btn-outline-light w-100 mt-2">Limpiar</a>
                </form>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-lg-9">
            @if($productos->count() > 0)
                <div class="row g-4">
                    @foreach($productos as $producto)
                        <div class="col-md-4">
                            <div class="product-card">
                                <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/300x250?text=Sin+Imagen' }}" 
                                     alt="{{ $producto->nombre }}" 
                                     class="product-img">
                                <div class="p-3">
                                    <h5 class="product-title">{{ $producto->nombre }}</h5>
                                    <p class="text-white-50 small mb-2">
                                        {{ $producto->marca ? $producto->marca->caracteristica->nombre : 'Sin marca' }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="product-price">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                        @if($producto->inventario && $producto->inventario->stock > 0)
                                            <span class="badge bg-success">Disponible</span>
                                        @else
                                            <span class="badge bg-danger">Agotado</span>
                                        @endif
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('tienda.show', $producto->id) }}" class="btn btn-outline-light">
                                            Ver Detalles
                                        </a>
                                        @if($producto->inventario && $producto->inventario->stock > 0)
                                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                                <input type="hidden" name="cantidad" value="1">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $productos->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 5rem; color: var(--ice-blue);"></i>
                    <h3 class="text-white mt-3">No se encontraron productos</h3>
                    <p class="text-white-50">Intenta ajustar los filtros de búsqueda</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

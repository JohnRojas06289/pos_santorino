@extends('tienda.layout')

@section('title', 'Catálogo - Bajo Cero')

@section('styles')
<style>
    .page-header {
        text-align: center;
        padding: 5rem 0 3rem;
        background: linear-gradient(135deg, var(--blue-light) 0%, var(--cream) 100%);
        border-bottom: 3px solid var(--blue-medium);
        margin-bottom: 3rem;
    }

    .page-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 1rem;
    }

    .page-subtitle {
        color: var(--blue-medium);
        font-size: 1.2rem;
        font-weight: 400;
    }

    .filter-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        padding: 2rem;
        position: sticky;
        top: 100px;
        box-shadow: 0 4px 20px rgba(29, 53, 87, 0.1);
    }

    .filter-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid var(--blue-medium);
    }

    .form-label {
        color: var(--blue-dark);
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        background: var(--cream);
        border: 2px solid var(--blue-light);
        color: var(--text-dark);
        border-radius: 6px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        background: var(--text-light);
        border-color: var(--blue-medium);
        color: var(--text-dark);
        box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
        outline: none;
    }

    .form-control::placeholder {
        color: var(--text-gray);
    }

    .product-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 0 4px 15px rgba(29, 53, 87, 0.1);
    }

    .product-card::before {
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

    .product-card:hover::before {
        transform: scaleX(1);
    }

    .product-card:hover {
        transform: translateY(-10px);
        border-color: var(--blue-medium);
        box-shadow: 0 20px 60px rgba(29, 53, 87, 0.2);
    }

    .product-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        transition: transform 0.4s ease;
        background: var(--cream);
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .product-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        color: var(--blue-dark);
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        min-height: 2.8rem;
    }

    .product-brand {
        color: var(--blue-medium);
        font-size: 0.85rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
    }

    .product-price {
        color: var(--blue-dark);
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: 'Space Grotesk', sans-serif;
    }

    .product-stock {
        margin-bottom: 1rem;
    }

    .product-actions {
        margin-top: auto;
        display: flex;
        gap: 0.5rem;
        flex-direction: column;
    }

    .btn-product {
        background: transparent;
        border: 2px solid var(--blue-dark);
        color: var(--blue-dark);
        padding: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-product:hover {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: var(--text-light);
        transform: translateY(-2px);
    }

    .btn-add-cart {
        background: var(--blue-dark);
        border: 2px solid var(--blue-dark);
        color: var(--text-light);
    }

    .btn-add-cart:hover {
        background: var(--blue-medium);
        border-color: var(--blue-medium);
        color: var(--text-light);
    }

    .badge {
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-success {
        background: var(--blue-light);
        color: var(--blue-dark);
    }

    .badge-danger {
        background: var(--accent);
        color: var(--text-light);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--text-light);
        border-radius: 12px;
        border: 2px solid var(--blue-light);
    }

    .empty-icon {
        font-size: 5rem;
        color: var(--blue-medium);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .empty-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2rem;
        color: var(--blue-dark);
        margin-bottom: 1rem;
    }

    .empty-text {
        color: var(--text-gray);
        font-size: 1rem;
    }

    .pagination {
        margin-top: 3rem;
    }

    .page-link {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        color: var(--blue-dark);
        border-radius: 6px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }

    .page-link:hover {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: var(--text-light);
    }

    .page-item.active .page-link {
        background: var(--blue-dark);
        border-color: var(--blue-dark);
        color: var(--text-light);
    }

    .results-count {
        color: var(--blue-medium);
        font-weight: 500;
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Nuestro Catálogo</h1>
        <p class="page-subtitle">Descubre chaquetas y gorras de última tendencia</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Filtros -->
        <div class="col-lg-3 mb-4">
            <div class="filter-card">
                <h5 class="filter-title">
                    <i class="bi bi-funnel"></i> Filtros
                </h5>
                <form action="{{ route('tienda.index') }}" method="GET">
                    <!-- Búsqueda -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-search"></i> Buscar
                        </label>
                        <input type="text" name="buscar" class="form-control" placeholder="Nombre del producto" value="{{ request('buscar') }}">
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-tags"></i> Categoría
                        </label>
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
                        <label class="form-label">
                            <i class="bi bi-star"></i> Marca
                        </label>
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
                        <label class="form-label">
                            <i class="bi bi-currency-dollar"></i> Precio Mínimo
                        </label>
                        <input type="number" name="precio_min" class="form-control" placeholder="$0" value="{{ request('precio_min') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio Máximo</label>
                        <input type="number" name="precio_max" class="form-control" placeholder="$1000" value="{{ request('precio_max') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-check-circle"></i> Aplicar Filtros
                    </button>
                    <a href="{{ route('tienda.index') }}" class="btn btn-outline-light w-100">
                        <i class="bi bi-x-circle"></i> Limpiar
                    </a>
                </form>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-lg-9">
            @if($productos->count() > 0)
                <div class="results-count">
                    <i class="bi bi-grid"></i> Mostrando {{ $productos->count() }} producto(s)
                </div>
                <div class="row g-4">
                    @foreach($productos as $producto)
                        <div class="col-md-4 col-sm-6">
                            <div class="product-card">
                                <a href="{{ route('tienda.show', $producto->id) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ $producto->img_path ? asset($producto->img_path) : 'https://via.placeholder.com/300x300?text=Sin+Imagen' }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="product-img">
                                </a>
                                <div class="product-body">
                                    <a href="{{ route('tienda.show', $producto->id) }}" style="text-decoration: none; color: inherit;">
                                        <h5 class="product-title">{{ $producto->nombre }}</h5>
                                    </a>
                                    <p class="product-brand">
                                        {{ $producto->marca ? $producto->marca->caracteristica->nombre : 'Sin marca' }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="product-price">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                        @if($producto->inventario && $producto->inventario->stock > 0)
                                            <span class="badge badge-success">Disponible</span>
                                        @else
                                            <span class="badge badge-danger">Agotado</span>
                                        @endif
                                    </div>
                                    @if($producto->inventario && $producto->inventario->stock > 0)
                                        <div class="product-stock">
                                            <small class="text-muted">
                                                <i class="bi bi-box"></i> Stock: {{ $producto->inventario->stock }} unidades
                                            </small>
                                        </div>
                                    @endif
                                    <div class="product-actions">
                                        <a href="{{ route('tienda.show', $producto->id) }}" class="btn btn-product">
                                            <i class="bi bi-eye"></i> Ver Detalles
                                        </a>
                                        @if($producto->inventario && $producto->inventario->stock > 0)
                                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                                <input type="hidden" name="cantidad" value="1">
                                                <button type="submit" class="btn btn-product btn-add-cart">
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
                <div class="d-flex justify-content-center mt-5">
                    {{ $productos->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox empty-icon"></i>
                    <h3 class="empty-title">No se encontraron productos</h3>
                    <p class="empty-text">Intenta ajustar los filtros de búsqueda para encontrar lo que buscas</p>
                    <a href="{{ route('tienda.index') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-left"></i> Ver Todos los Productos
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

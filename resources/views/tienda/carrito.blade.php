@extends('tienda.layout')

@section('title', 'Carrito de Compras - Bajo Cero')

@section('styles')
<style>
    .cart-header {
        text-align: center;
        padding: 3rem 0 2rem;
        background: linear-gradient(135deg, var(--blue-light) 0%, var(--cream) 100%);
        border-bottom: 3px solid var(--blue-medium);
        margin-bottom: 3rem;
    }

    .cart-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 0.5rem;
    }

    .cart-subtitle {
        color: var(--blue-medium);
        font-size: 1.1rem;
    }

    .cart-item-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(29, 53, 87, 0.1);
    }

    .cart-item-card:hover {
        border-color: var(--blue-medium);
        box-shadow: 0 8px 25px rgba(29, 53, 87, 0.15);
    }

    .cart-item-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid var(--blue-light);
    }

    .cart-item-name {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--blue-dark);
        margin-bottom: 0.5rem;
    }

    .cart-item-price {
        color: var(--blue-medium);
        font-weight: 500;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 2px solid var(--blue-light);
        background: var(--cream);
        color: var(--blue-dark);
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .quantity-btn:hover {
        background: var(--blue-dark);
        color: var(--text-light);
        border-color: var(--blue-dark);
    }

    .quantity-input-cart {
        width: 80px;
        text-align: center;
        border: 2px solid var(--blue-light);
        border-radius: 6px;
        padding: 0.5rem;
        font-weight: 600;
        color: var(--blue-dark);
    }

    .quantity-input-cart:focus {
        border-color: var(--blue-medium);
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
    }

    .subtotal {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--blue-dark);
    }

    .summary-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        padding: 2rem;
        position: sticky;
        top: 100px;
        box-shadow: 0 4px 20px rgba(29, 53, 87, 0.1);
    }

    .summary-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid var(--blue-medium);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: var(--text-gray);
    }

    .summary-row.total {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--blue-dark);
        padding-top: 1rem;
        border-top: 2px solid var(--blue-light);
        margin-top: 1rem;
    }

    .btn-checkout {
        background: var(--blue-dark);
        border: none;
        color: var(--text-light);
        padding: 1rem;
        font-weight: 600;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 6px;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 1rem;
    }

    .btn-checkout:hover {
        background: var(--blue-medium);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(29, 53, 87, 0.4);
        color: var(--text-light);
    }

    .btn-continue {
        background: transparent;
        border: 2px solid var(--blue-dark);
        color: var(--blue-dark);
        padding: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 6px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-continue:hover {
        background: var(--blue-dark);
        color: var(--text-light);
    }

    .empty-cart {
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
        margin-bottom: 2rem;
    }

    .btn-delete {
        background: var(--accent);
        border: none;
        color: var(--text-light);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: #d32f2f;
        transform: scale(1.05);
    }

    .alert-success {
        background: var(--blue-light);
        border: 2px solid var(--blue-medium);
        color: var(--blue-dark);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="cart-header">
    <div class="container-fluid px-4 px-lg-5">
        <h1 class="cart-title">
            <i class="bi bi-cart3"></i> Carrito de Compras
        </h1>
        <p class="cart-subtitle">Revisa tus productos antes de finalizar la compra</p>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(count($carrito) > 0)
        <div class="row">
            <div class="col-lg-8">
                @foreach($carrito as $id => $item)
                    <div class="cart-item-card">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ $item['imagen'] ? asset($item['imagen']) : 'https://via.placeholder.com/120' }}" 
                                     alt="{{ $item['nombre'] }}" 
                                     class="cart-item-image">
                            </div>
                            <div class="col-md-4">
                                <h5 class="cart-item-name">{{ $item['nombre'] }}</h5>
                                <p class="cart-item-price">${{ number_format($item['precio'], 0, ',', '.') }} c/u</p>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('carrito.actualizar') }}" method="POST" class="quantity-control">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $id }}">
                                    <button type="button" class="quantity-btn" onclick="decreaseQuantity(this)">-</button>
                                    <input type="number" 
                                           name="cantidad" 
                                           value="{{ $item['cantidad'] }}" 
                                           min="1" 
                                           class="quantity-input-cart"
                                           onchange="this.form.submit()">
                                    <button type="button" class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                                </form>
                            </div>
                            <div class="col-md-2 text-center">
                                <span class="subtotal">${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</span>
                            </div>
                            <div class="col-md-1 text-center">
                                <form action="{{ route('carrito.eliminar', $id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <form action="{{ route('carrito.vaciar') }}" method="POST" onsubmit="return confirm('¿Estás seguro de vaciar el carrito?')">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="bi bi-x-circle"></i> Vaciar Carrito
                    </button>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="summary-title">Resumen del Pedido</h5>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Envío:</span>
                        <span class="text-success">
                            <i class="bi bi-check-circle"></i> Gratis
                        </span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-checkout">
                        <i class="bi bi-credit-card"></i> Proceder al Pago
                    </a>
                    <a href="{{ route('tienda.index') }}" class="btn btn-continue">
                        <i class="bi bi-arrow-left"></i> Seguir Comprando
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <i class="bi bi-cart-x empty-icon"></i>
            <h3 class="empty-title">Tu carrito está vacío</h3>
            <p class="empty-text">Agrega productos para comenzar tu compra</p>
            <a href="{{ route('tienda.index') }}" class="btn btn-primary">
                <i class="bi bi-shop"></i> Ir a la Tienda
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function increaseQuantity(btn) {
        const input = btn.previousElementSibling;
        const currentValue = parseInt(input.value);
        input.value = currentValue + 1;
        input.dispatchEvent(new Event('change'));
    }

    function decreaseQuantity(btn) {
        const input = btn.nextElementSibling;
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            input.dispatchEvent(new Event('change'));
        }
    }
</script>
@endsection

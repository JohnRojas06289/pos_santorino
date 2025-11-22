@extends('tienda.layout')

@section('title', 'Carrito de Compras - Bajo Cero')

@section('content')
<div class="container">
    <h1 class="text-white fw-bold mb-5">Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($carrito) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carrito as $id => $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item['imagen'] ? asset($item['imagen']) : 'https://via.placeholder.com/80' }}" 
                                                 alt="{{ $item['nombre'] }}" 
                                                 class="rounded me-3" 
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                            <span>{{ $item['nombre'] }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">${{ number_format($item['precio'], 0, ',', '.') }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('carrito.actualizar') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{ $id }}">
                                            <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" 
                                                   class="form-control form-control-sm" style="width: 80px;" 
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="align-middle text-info fw-bold">
                                        ${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('carrito.vaciar') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Vaciar Carrito</button>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Resumen del Pedido</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>${{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Envío:</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong class="text-info fs-4">${{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 btn-lg">
                            Proceder al Pago
                        </a>
                        <a href="{{ route('tienda.index') }}" class="btn btn-outline-light w-100 mt-2">
                            Seguir Comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: var(--ice-blue);"></i>
            <h3 class="text-white mt-3">Tu carrito está vacío</h3>
            <p class="text-white-50">Agrega productos para comenzar tu compra</p>
            <a href="{{ route('tienda.index') }}" class="btn btn-primary mt-3">Ir a la Tienda</a>
        </div>
    @endif
</div>
@endsection

@extends('tienda.layout')

@section('title', 'Pedido Confirmado - Bajo Cero')

@section('styles')
<style>
    .confirmation-header {
        text-align: center;
        padding: 4rem 0 3rem;
        background: linear-gradient(135deg, #4CAF50 0%, var(--blue-light) 100%);
        border-bottom: 3px solid #4CAF50;
        margin-bottom: 3rem;
    }

    .success-icon {
        font-size: 5rem;
        color: #4CAF50;
        margin-bottom: 1rem;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }

    .confirmation-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 0.5rem;
    }

    .order-number {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        color: var(--blue-medium);
        font-weight: 600;
    }

    .info-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(29, 53, 87, 0.1);
    }

    .info-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--blue-light);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--blue-light);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--text-gray);
        font-weight: 500;
    }

    .info-value {
        color: var(--blue-dark);
        font-weight: 600;
    }

    .product-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--cream);
        border-radius: 8px;
        margin-bottom: 0.75rem;
    }

    .product-name {
        color: var(--blue-dark);
        font-weight: 600;
    }

    .product-quantity {
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .product-price {
        color: var(--blue-medium);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 1.5rem 0;
        border-top: 2px solid var(--blue-medium);
        margin-top: 1rem;
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--blue-dark);
    }

    .btn-whatsapp {
        background: #25D366;
        border: none;
        color: white;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin: 0.5rem;
    }

    .btn-whatsapp:hover {
        background: #128C7E;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4);
    }

    .btn-continue {
        background: var(--blue-dark);
        border: none;
        color: var(--text-light);
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin: 0.5rem;
    }

    .btn-continue:hover {
        background: var(--blue-medium);
        color: var(--text-light);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(29, 53, 87, 0.4);
    }

    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        background: #FFF3CD;
        color: #856404;
        border: 2px solid #FFC107;
    }

    .next-steps {
        background: var(--blue-light);
        border-left: 4px solid var(--blue-medium);
        padding: 1.5rem;
        border-radius: 8px;
        margin-top: 2rem;
    }

    .next-steps h6 {
        color: var(--blue-dark);
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .next-steps ol {
        color: var(--text-dark);
        margin-bottom: 0;
    }

    .next-steps li {
        margin-bottom: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="confirmation-header">
    <div class="container-fluid px-4 px-lg-5">
        <i class="bi bi-check-circle-fill success-icon"></i>
        <h1 class="confirmation-title">¡Pedido Realizado Exitosamente!</h1>
        <p class="order-number">Número de Pedido: <strong>{{ $pedido->numero_pedido }}</strong></p>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Información del Pedido -->
            <div class="info-card">
                <h5 class="info-card-title">
                    <i class="bi bi-receipt"></i> Detalles del Pedido
                </h5>
                <div class="info-row">
                    <span class="info-label">Estado:</span>
                    <span class="status-badge">
                        <i class="bi bi-clock"></i> {{ $pedido->estado_texto }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Método de Pago:</span>
                    <span class="info-value">{{ ucfirst($pedido->metodo_pago) }}</span>
                </div>
            </div>

            <!-- Productos -->
            <div class="info-card">
                <h5 class="info-card-title">
                    <i class="bi bi-bag"></i> Productos Ordenados
                </h5>
                @foreach($pedido->productos as $producto)
                    <div class="product-item">
                        <div>
                            <div class="product-name">{{ $producto->nombre }}</div>
                            <div class="product-quantity">Cantidad: {{ $producto->pivot->cantidad }}</div>
                        </div>
                        <div class="product-price">
                            ${{ number_format($producto->pivot->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <div class="total-row">
                    <span>Total:</span>
                    <span>${{ number_format($pedido->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Información de Envío -->
            <div class="info-card">
                <h5 class="info-card-title">
                    <i class="bi bi-truck"></i> Información de Envío
                </h5>
                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value">{{ $pedido->cliente_nombre }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Teléfono:</span>
                    <span class="info-value">{{ $pedido->cliente_telefono }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $pedido->cliente_email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Dirección:</span>
                    <span class="info-value">{{ $pedido->cliente_direccion }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ciudad:</span>
                    <span class="info-value">{{ $pedido->cliente_ciudad }}</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Próximos Pasos -->
            <div class="info-card">
                <h5 class="info-card-title">
                    <i class="bi bi-list-check"></i> Próximos Pasos
                </h5>
                <div class="next-steps">
                    <h6><i class="bi bi-info-circle"></i> ¿Qué sigue?</h6>
                    <ol>
                        <li>Recibirás una confirmación por WhatsApp</li>
                        <li>Nuestro equipo revisará tu pedido</li>
                        <li>Te contactaremos para coordinar la entrega</li>
                        <li>¡Disfruta tus productos!</li>
                    </ol>
                </div>

                <div class="text-center mt-4">
                    <a href="https://wa.me/573001234567?text=Hola%2C%20tengo%20una%20consulta%20sobre%20mi%20pedido%20{{ $pedido->numero_pedido }}" 
                       class="btn btn-whatsapp" 
                       target="_blank">
                        <i class="bi bi-whatsapp"></i> Contactar por WhatsApp
                    </a>
                    <a href="{{ route('tienda.index') }}" class="btn btn-continue">
                        <i class="bi bi-shop"></i> Seguir Comprando
                    </a>
                </div>

                <div class="alert alert-info mt-3">
                    <i class="bi bi-envelope"></i> 
                    <small>Hemos enviado un resumen de tu pedido a <strong>{{ $pedido->cliente_email }}</strong></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

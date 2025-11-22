@extends('tienda.layout')

@section('title', 'Checkout - Bajo Cero')

@section('styles')
<style>
    .checkout-header {
        text-align: center;
        padding: 3rem 0 2rem;
        background: linear-gradient(135deg, var(--blue-light) 0%, var(--cream) 100%);
        border-bottom: 3px solid var(--blue-medium);
        margin-bottom: 3rem;
    }

    .checkout-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--blue-dark);
    }

    .form-card {
        background: var(--text-light);
        border: 2px solid var(--blue-light);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(29, 53, 87, 0.1);
    }

    .form-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--blue-light);
    }

    .form-label {
        color: var(--blue-dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        background: var(--cream);
        border: 2px solid var(--blue-light);
        color: var(--text-dark);
        border-radius: 6px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background: var(--text-light);
        border-color: var(--blue-medium);
        box-shadow: 0 0 0 0.2rem rgba(69, 123, 157, 0.25);
        outline: none;
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

    .product-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--blue-light);
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        color: var(--text-gray);
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-top: 2px solid var(--blue-medium);
        margin-top: 1rem;
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--blue-dark);
    }

    .btn-submit {
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
        margin-top: 1.5rem;
    }

    .btn-submit:hover {
        background: var(--blue-medium);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(29, 53, 87, 0.4);
        color: var(--text-light);
    }

    .payment-option {
        background: var(--cream);
        border: 2px solid var(--blue-light);
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .payment-option:hover {
        border-color: var(--blue-medium);
        background: var(--text-light);
    }

    .payment-option input[type="radio"]:checked + label {
        color: var(--blue-dark);
        font-weight: 600;
    }

    .alert-danger {
        background: #fee;
        border: 2px solid var(--accent);
        color: #c00;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="checkout-header">
    <div class="container-fluid px-4 px-lg-5">
        <h1 class="checkout-title">
            <i class="bi bi-credit-card"></i> Finalizar Compra
        </h1>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5">
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i> Por favor corrige los errores en el formulario
        </div>
    @endif

    <form action="{{ route('checkout.procesar') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-7">
                <!-- Información de Contacto -->
                <div class="form-card">
                    <h5 class="form-card-title">
                        <i class="bi bi-person"></i> Información de Contacto
                    </h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nombre Completo *</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" required value="{{ old('nombre') }}" placeholder="Juan Pérez">
                            @error('nombre')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" placeholder="juan@example.com">
                            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono / WhatsApp *</label>
                            <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror" required value="{{ old('telefono') }}" placeholder="300 123 4567">
                            @error('telefono')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                </div>

                <!-- Dirección de Envío -->
                <div class="form-card">
                    <h5 class="form-card-title">
                        <i class="bi bi-geo-alt"></i> Dirección de Envío
                    </h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Dirección Completa *</label>
                            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" required value="{{ old('direccion') }}" placeholder="Calle 10 #10-25, Apto 301">
                            @error('direccion')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ciudad *</label>
                            <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror" required value="{{ old('ciudad', 'Bogotá') }}" placeholder="Bogotá">
                            @error('ciudad')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Departamento</label>
                            <input type="text" name="departamento" class="form-control" value="{{ old('departamento', 'Cundinamarca') }}" placeholder="Cundinamarca">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Código Postal</label>
                            <input type="text" name="codigo_postal" class="form-control" value="{{ old('codigo_postal') }}" placeholder="110111">
                        </div>
                    </div>
                </div>

                <!-- Método de Pago -->
                <div class="form-card">
                    <h5 class="form-card-title">
                        <i class="bi bi-wallet2"></i> Método de Pago
                    </h5>
                    
                    <!-- Opción Efectivo -->
                    <div class="payment-option mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="efectivo" value="efectivo" checked onchange="togglePaymentInfo()">
                            <label class="form-check-label ms-2" for="efectivo">
                                <i class="bi bi-cash"></i> Efectivo (Pago contra entrega)
                            </label>
                        </div>
                        <div id="info-efectivo" class="payment-info mt-2 text-muted small ps-4">
                            Pagas al recibir tu pedido en la dirección indicada.
                        </div>
                    </div>

                    <!-- Opción Transferencia -->
                    <div class="payment-option mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="transferencia" value="transferencia" onchange="togglePaymentInfo()">
                            <label class="form-check-label ms-2" for="transferencia">
                                <i class="bi bi-bank"></i> Transferencia Bancaria
                            </label>
                        </div>
                        <div id="info-transferencia" class="payment-info mt-2 ps-4" style="display: none;">
                            <div class="alert alert-info mb-0">
                                <strong><i class="bi bi-info-circle"></i> Datos para transferencia:</strong><br>
                                Bancolombia Ahorros: 123-456789-00<br>
                                Nequi/DaviPlata: 300 123 4567<br>
                                <small>Envía el comprobante al WhatsApp después de finalizar.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Opción PSE -->
                    <div class="payment-option mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="pse" value="pse" onchange="togglePaymentInfo()">
                            <label class="form-check-label ms-2" for="pse">
                                <i class="bi bi-credit-card"></i> PSE / Tarjeta
                            </label>
                        </div>
                        <div id="info-pse" class="payment-info mt-2 ps-4" style="display: none;">
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-circle"></i> <strong>Nota:</strong> Te enviaremos un link de pago seguro (Wompi/Bold) a tu correo y WhatsApp una vez confirmado el pedido.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notas -->
                <div class="form-card">
                    <h5 class="form-card-title">
                        <i class="bi bi-chat-text"></i> Notas del Pedido (Opcional)
                    </h5>
                    <textarea name="notas" class="form-control" rows="3" placeholder="Instrucciones especiales para la entrega, talla, color preferido, etc.">{{ old('notas') }}</textarea>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="summary-card">
                    <h5 class="form-card-title">
                        <i class="bi bi-receipt"></i> Resumen del Pedido
                    </h5>
                    
                    <div class="products-list mb-3">
                        @foreach($productos as $item)
                            <div class="product-item">
                                <span>{{ $item['nombre'] }} <strong>x{{ $item['cantidad'] }}</strong></span>
                                <span>${{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>IVA (19%):</span>
                        <span>${{ number_format($impuestos, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Envío:</span>
                        <span class="text-success">
                            <i class="bi bi-check-circle"></i> Gratis
                        </span>
                    </div>

                    <div class="summary-total">
                        <span>Total:</span>
                        <span>${{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn btn-submit" id="btn-submit">
                        <span class="normal-text"><i class="bi bi-check-circle"></i> Confirmar Pedido</span>
                        <span class="loading-text" style="display: none;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...</span>
                    </button>
                    <a href="{{ route('carrito.index') }}" class="btn btn-outline-light w-100 mt-2">
                        <i class="bi bi-arrow-left"></i> Volver al Carrito
                    </a>

                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <i class="bi bi-shield-check"></i> Compra 100% segura
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function togglePaymentInfo() {
        // Ocultar todos
        document.getElementById('info-efectivo').style.display = 'none';
        document.getElementById('info-transferencia').style.display = 'none';
        document.getElementById('info-pse').style.display = 'none';

        // Mostrar seleccionado
        if (document.getElementById('efectivo').checked) {
            document.getElementById('info-efectivo').style.display = 'block';
        } else if (document.getElementById('transferencia').checked) {
            document.getElementById('info-transferencia').style.display = 'block';
        } else if (document.getElementById('pse').checked) {
            document.getElementById('info-pse').style.display = 'block';
        }
    }

    // Ejecutar al cargar por si hay un valor old()
    document.addEventListener('DOMContentLoaded', function() {
        togglePaymentInfo();
        
        // Loading state on submit
        const form = document.querySelector('form');
        const btn = document.getElementById('btn-submit');
        const normalText = btn.querySelector('.normal-text');
        const loadingText = btn.querySelector('.loading-text');

        form.addEventListener('submit', function() {
            btn.disabled = true;
            normalText.style.display = 'none';
            loadingText.style.display = 'inline-block';
        });
    });
</script>
@endsection

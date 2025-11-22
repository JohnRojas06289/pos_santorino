@extends('tienda.layout')

@section('title', 'Checkout - Bajo Cero')

@section('content')
<div class="container">
    <h1 class="text-white fw-bold mb-5">Finalizar Compra</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('checkout.procesar') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-7">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Información de Contacto</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nombre Completo *</label>
                                <input type="text" name="nombre_cliente" class="form-control" required value="{{ old('nombre_cliente') }}">
                                @error('nombre_cliente')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teléfono *</label>
                                <input type="tel" name="telefono" class="form-control" required value="{{ old('telefono') }}">
                                @error('telefono')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Dirección de Envío</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Dirección *</label>
                                <input type="text" name="direccion_envio" class="form-control" required value="{{ old('direccion_envio') }}">
                                @error('direccion_envio')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ciudad *</label>
                                <input type="text" name="ciudad" class="form-control" required value="{{ old('ciudad') }}">
                                @error('ciudad')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Código Postal</label>
                                <input type="text" name="codigo_postal" class="form-control" value="{{ old('codigo_postal') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Método de Pago</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="transferencia" value="transferencia" checked>
                            <label class="form-check-label" for="transferencia">
                                Transferencia Bancaria
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="contraentrega" value="contraentrega">
                            <label class="form-check-label" for="contraentrega">
                                Pago Contraentrega
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Notas del Pedido (Opcional)</h5>
                        <textarea name="notas" class="form-control" rows="3" placeholder="Instrucciones especiales para la entrega...">{{ old('notas') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Resumen del Pedido</h5>
                        @foreach($carrito as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['nombre'] }} x{{ $item['cantidad'] }}</span>
                                <span>${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
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
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            Confirmar Pedido
                        </button>
                        <a href="{{ route('carrito.index') }}" class="btn btn-outline-light w-100 mt-2">
                            Volver al Carrito
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

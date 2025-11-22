@extends('tienda.layout')

@section('title', 'Pedido Confirmado - Bajo Cero')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h1 class="text-white fw-bold mt-3">¡Pedido Confirmado!</h1>
                <p class="text-white-50">Gracias por tu compra. Hemos recibido tu pedido correctamente.</p>
            </div>

            <div class="card bg-dark text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Detalles del Pedido</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Número de Pedido:</strong><br>
                            <span class="text-info">#{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Fecha:</strong><br>
                            {{ $pedido->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Estado:</strong><br>
                            <span class="badge bg-warning">Pendiente</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Total:</strong><br>
                            <span class="text-info fs-5">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-dark text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <hr>
                    @foreach($pedido->productos as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item->producto->nombre }} x{{ $item->cantidad }}</span>
                            <span>${{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card bg-dark text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Información de Envío</h5>
                    <hr>
                    <p class="mb-1"><strong>Nombre:</strong> {{ $pedido->nombre_cliente }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $pedido->email }}</p>
                    <p class="mb-1"><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
                    <p class="mb-1"><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>
                    <p class="mb-0"><strong>Ciudad:</strong> {{ $pedido->ciudad }}</p>
                </div>
            </div>

            <div class="alert alert-info">
                <h6><i class="bi bi-info-circle"></i> Próximos Pasos</h6>
                <p class="mb-0">
                    @if($pedido->metodo_pago == 'transferencia')
                        Te enviaremos un correo con los datos bancarios para realizar la transferencia. 
                        Una vez confirmado el pago, procesaremos tu pedido.
                    @else
                        Nos pondremos en contacto contigo para coordinar la entrega y el pago.
                    @endif
                </p>
            </div>

            <div class="text-center">
                <a href="{{ route('tienda.index') }}" class="btn btn-primary">Volver a la Tienda</a>
            </div>
        </div>
    </div>
</div>
@endsection

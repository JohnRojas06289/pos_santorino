@extends('template')

@section('title', 'Detalle del Pedido')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pedido #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
        <li class="breadcrumb-item active">Detalle</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-box me-1"></i>
                    Productos del Pedido
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unit.</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->productos as $item)
                                <tr>
                                    <td>{{ $item->producto->nombre }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                                    <td>${{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th>${{ number_format($pedido->total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-truck me-1"></i>
                    Información de Envío
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $pedido->nombre_cliente }}</p>
                    <p><strong>Email:</strong> {{ $pedido->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
                    <p><strong>Dirección:</strong> {{ $pedido->direccion_envio }}</p>
                    <p><strong>Ciudad:</strong> {{ $pedido->ciudad }}</p>
                    @if($pedido->codigo_postal)
                        <p><strong>Código Postal:</strong> {{ $pedido->codigo_postal }}</p>
                    @endif
                    @if($pedido->notas)
                        <p><strong>Notas:</strong> {{ $pedido->notas }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Información del Pedido
                </div>
                <div class="card-body">
                    <p><strong>Estado:</strong> 
                        <span class="badge bg-{{ $pedido->estado_badge }}">{{ ucfirst($pedido->estado) }}</span>
                    </p>
                    <p><strong>Método de Pago:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
                    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    @if($pedido->venta_id)
                        <p><strong>Venta Asociada:</strong> 
                            <a href="{{ route('ventas.show', $pedido->venta_id) }}">#{{ $pedido->venta_id }}</a>
                        </p>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Cambiar Estado
                </div>
                <div class="card-body">
                    <form action="{{ route('pedidos.actualizar', $pedido->id) }}" method="POST">
                        @csrf
                        <select name="estado" class="form-select mb-3">
                            <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmado" {{ $pedido->estado == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                            <option value="procesando" {{ $pedido->estado == 'procesando' ? 'selected' : '' }}>Procesando</option>
                            <option value="enviado" {{ $pedido->estado == 'enviado' ? 'selected' : '' }}>Enviado</option>
                            <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">Actualizar Estado</button>
                    </form>
                </div>
            </div>

            @if(!$pedido->venta_id && $pedido->estado != 'cancelado')
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-cash-register me-1"></i>
                        Procesar Pedido
                    </div>
                    <div class="card-body">
                        <p class="small">Esto creará una venta en el sistema y descontará del inventario.</p>
                        <form action="{{ route('pedidos.procesar', $pedido->id) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de procesar este pedido como venta?')">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check"></i> Procesar como Venta
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

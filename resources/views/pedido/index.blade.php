@extends('template')

@section('title', 'Pedidos Online')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Pedidos Online</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Pedidos</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-shopping-cart me-1"></i>
            Lista de Pedidos
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pedidos as $pedido)
                        <tr>
                            <td>{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $pedido->nombre_cliente }}</td>
                            <td>{{ $pedido->email }}</td>
                            <td>${{ number_format($pedido->total, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $pedido->estado_badge }}">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay pedidos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $pedidos->links() }}
        </div>
    </div>
</div>
@endsection

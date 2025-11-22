@extends('layouts.app')

@section('title','Productos')

@push('css')
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .view-toggle .btn { border-radius: 0; }
    .view-toggle .btn:first-child { border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; }
    .view-toggle .btn:last-child { border-top-right-radius: .25rem; border-bottom-right-radius: .25rem; }
    .filter-badge { display:inline-block; margin:2px; }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    <div class="row mb-4">
        <div class="col-md-6">
            @can('crear-producto')
            <a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Añadir nuevo producto</a>
            @endcan
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group view-toggle" role="group">
                <button type="button" class="btn btn-outline-secondary" id="viewCards" onclick="toggleView('cards')"><i class="fas fa-th"></i> Cards</button>
                <button type="button" class="btn btn-outline-secondary active" id="viewList" onclick="toggleView('list')"><i class="fas fa-list"></i> Lista</button>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter me-1"></i> Filtros
            <button class="btn btn-sm btn-link float-end" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse"><i class="fas fa-chevron-down"></i></button>
        </div>
        <div class="collapse show" id="filterCollapse">
            <div class="card-body">
                <form method="GET" action="{{ route('productos.index') }}" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3"><label class="form-label">Buscar</label><input type="text" name="search" class="form-control" placeholder="Nombre, código..." value="{{ request('search') }}"></div>
                        <div class="col-md-2"><label class="form-label">Marca</label><select name="marca_id" class="form-select"><option value="">Todas</option>@foreach($marcas as $marca)<option value="{{ $marca->id }}" {{ request('marca_id') == $marca->id ? 'selected' : '' }}>{{ $marca->caracteristica->nombre }}</option>@endforeach</select></div>
                        <div class="col-md-2"><label class="form-label">Categoría</label><select name="categoria_id" class="form-select"><option value="">Todas</option>@foreach($categorias as $cat)<option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->caracteristica->nombre }}</option>@endforeach</select></div>
                        <div class="col-md-2"><label class="form-label">Color</label><select name="color" class="form-select"><option value="">Todos</option>@foreach($colores as $c)<option value="{{ $c }}" {{ request('color') == $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>@endforeach</select></div>
                        <div class="col-md-2"><label class="form-label">Género</label><select name="genero" class="form-select"><option value="">Todos</option><option value="unisex" {{ request('genero') == 'unisex' ? 'selected' : '' }}>Unisex</option><option value="hombre" {{ request('genero') == 'hombre' ? 'selected' : '' }}>Hombre</option><option value="mujer" {{ request('genero') == 'mujer' ? 'selected' : '' }}>Mujer</option><option value="niño" {{ request('genero') == 'niño' ? 'selected' : '' }}>Niño</option><option value="niña" {{ request('genero') == 'niña' ? 'selected' : '' }}>Niña</option></select></div>
                        <div class="col-md-1"><label class="form-label">Estado</label><select name="estado" class="form-select"><option value="">Todos</option><option value="1" {{ request('estado') === '1' ? 'selected' : '' }}>Activo</option><option value="0" {{ request('estado') === '0' ? 'selected' : '' }}>Inactivo</option></select></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3"><label class="form-label">Ordenar por</label><select name="order_by" class="form-select"><option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Fecha</option><option value="nombre" {{ request('order_by') == 'nombre' ? 'selected' : '' }}>Nombre</option><option value="precio" {{ request('order_by') == 'precio' ? 'selected' : '' }}>Precio</option><option value="stock" {{ request('order_by') == 'stock' ? 'selected' : '' }}>Stock</option></select></div>
                        <div class="col-md-2"><label class="form-label">Dirección</label><select name="order_dir" class="form-select"><option value="desc" {{ request('order_dir') == 'desc' ? 'selected' : '' }}>Descendente</option><option value="asc" {{ request('order_dir') == 'asc' ? 'selected' : '' }}>Ascendente</option></select></div>
                        <div class="col-md-7 d-flex align-items-end"><button type="submit" class="btn btn-primary me-2"><i class="fas fa-search"></i> Aplicar filtros</button><a href="{{ route('productos.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Limpiar</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Cards view --}}
    <div id="cardsView" style="display:none;">
        <div class="row g-4">
            @forelse($productos as $item)
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="{{ $item->img_path ? asset($item->img_path) : 'https://via.placeholder.com/300x200?text=Sin+Imagen' }}" class="card-img-top product-img" alt="{{ $item->nombre }}">
                        <div class="card-body">
                            <h6 class="card-title">{{ $item->nombre }}</h6>
                            <p class="card-text small text-muted mb-1"><strong>Código:</strong> {{ $item->codigo }}</p>
                            <p class="card-text small text-muted mb-1"><strong>Marca:</strong> {{ $item->marca->caracteristica->nombre ?? 'Sin marca' }}</p>
                            @if($item->color)<span class="badge bg-secondary">{{ ucfirst($item->color) }}</span>@endif
                            <span class="badge bg-{{ $item->genero == 'hombre' ? 'primary' : ($item->genero == 'mujer' ? 'danger' : 'info') }}">{{ ucfirst($item->genero) }}</span>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 text-primary">${{ number_format($item->precio ?? 0, 0, ',', '.') }}</span>
                                <span class="badge bg-{{ $item->estado ? 'success' : 'danger' }}">{{ $item->estado ? 'Activo' : 'Inactivo' }}</span>
                            </div>
                            @if($item->inventario)
                                <small class="text-muted">Stock: {{ $item->inventario->stock }}</small>
                            @else
                                <small class="text-danger">Sin inventario</small>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between">
                                @can('editar-producto')
                                    <a href="{{ route('productos.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Editar</a>
                                @endcan
                                @can('crear-inventario')
                                    <form action="{{ route('inventario.create') }}" method="get"><input type="hidden" name="producto_id" value="{{ $item->id }}"><button type="submit" class="btn btn-sm btn-outline-secondary" title="Inicializar"><i class="fa-solid fa-rotate"></i></button></form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="alert alert-info text-center">No se encontraron productos.</div></div>
            @endforelse
        </div>
    </div>

    {{-- List view --}}
    <div id="listView">
        <div class="card">
            <div class="card-header"><i class="fas fa-table me-1"></i> Tabla de productos</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead><tr><th>Imagen</th><th>Producto</th><th>Precio</th><th>Marca</th><th>Categoría</th><th>Color</th><th>Género</th><th>Stock</th><th>Estado</th><th>Acciones</th></tr></thead>
                        <tbody>
                            @forelse($productos as $item)
                                <tr>
                                    <td><img src="{{ $item->img_path ? asset($item->img_path) : 'https://via.placeholder.com/50' }}" alt="{{ $item->nombre }}" style="width:50px;height:50px;object-fit:cover;" class="rounded"></td>
                                    <td><strong>{{ $item->nombre }}</strong><br><small class="text-muted">{{ $item->codigo }}</small></td>
                                    <td>${{ number_format($item->precio ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $item->marca->caracteristica->nombre ?? 'Sin marca' }}</td>
                                    <td>{{ $item->categoria->caracteristica->nombre ?? 'Sin categoría' }}</td>
                                    <td>@if($item->color)<span class="badge bg-secondary">{{ ucfirst($item->color) }}</span>@else - @endif</td>
                                    <td><span class="badge bg-{{ $item->genero == 'hombre' ? 'primary' : ($item->genero == 'mujer' ? 'danger' : 'info') }}">{{ ucfirst($item->genero) }}</span></td>
                                    <td>@if($item->inventario)<span class="badge bg-{{ $item->inventario->stock > 10 ? 'success' : ($item->inventario->stock > 0 ? 'warning' : 'danger') }}">{{ $item->inventario->stock }}</span>@else <span class="badge bg-secondary">Sin inv.</span>@endif</td>
                                    <td><span class="badge bg-{{ $item->estado ? 'success' : 'danger' }}">{{ $item->estado ? 'Activo' : 'Inactivo' }}</span></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @can('editar-producto')
                                                <a href="{{ route('productos.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('crear-inventario')
                                                <form action="{{ route('inventario.create') }}" method="get" class="d-inline"><input type="hidden" name="producto_id" value="{{ $item->id }}"><button type="submit" class="btn btn-sm btn-outline-secondary" title="Inicializar"><i class="fa-solid fa-rotate"></i></button></form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="10" class="text-center">No se encontraron productos.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection

@push('js')
<script>
function toggleView(view){
    const cards=document.getElementById('cardsView');
    const list=document.getElementById('listView');
    const btnCards=document.getElementById('viewCards');
    const btnList=document.getElementById('viewList');
    if(view==='cards'){
        cards.style.display='block';
        list.style.display='none';
        btnCards.classList.add('active');
        btnList.classList.remove('active');
        localStorage.setItem('productView','cards');
    }else{
        cards.style.display='none';
        list.style.display='block';
        btnCards.classList.remove('active');
        btnList.classList.add('active');
        localStorage.setItem('productView','list');
    }
}
document.addEventListener('DOMContentLoaded',()=>{ const saved=localStorage.getItem('productView')||'list'; toggleView(saved); });
</script>
@endpush
@extends('layouts.app')

@section('title','Panel')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .card-counter{
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 100px;
        border-radius: 5px;
        transition: .3s linear all;
    }
    .card-counter:hover{
        box-shadow: 4px 4px 20px #DADADA;
        transition: .3s linear all;
    }
    .card-counter.primary{
        background-color: #007bff;
        color: #FFF;
    }
    .card-counter.danger{
        background-color: #ef5350;
        color: #FFF;
    }  
    .card-counter.success{
        background-color: #66bb6a;
        color: #FFF;
    }  
    .card-counter.info{
        background-color: #26c6da;
        color: #FFF;
    }  
    .card-counter i{
        font-size: 5em;
        opacity: 0.2;
    }
    .card-counter .count-numbers{
        position: absolute;
        right: 35px;
        top: 20px;
        font-size: 32px;
        display: block;
    }
    .card-counter .count-name{
        position: absolute;
        right: 35px;
        top: 65px;
        font-style: italic;
        text-transform: capitalize;
        opacity: 0.5;
        display: block;
        font-size: 18px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Panel de Control</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Resumen General</li>
    </ol>

    {{-- Filtros de Fecha --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('panel') }}" method="GET" class="row align-items-end">
                <div class="col-md-4">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" value="{{ $fechaInicio }}">
                </div>
                <div class="col-md-4">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" value="{{ $fechaFin }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <!----Ventas Hoy--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-chart-line fa-2x"></i>
                            <div class="mt-2">Ventas Hoy</div>
                        </div>
                        <div class="col-4 text-end">
                            <p class="fw-bold fs-4 mb-0">${{ number_format($ventasHoy, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----Ventas Mes--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-money-bill-trend-up fa-2x"></i>
                            <div class="mt-2">Ventas Periodo</div>
                        </div>
                        <div class="col-4 text-end">
                            <p class="fw-bold fs-4 mb-0">${{ number_format($ventasMes, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----Compras Mes--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-cart-shopping fa-2x"></i>
                            <div class="mt-2">Compras Periodo</div>
                        </div>
                        <div class="col-4 text-end">
                            <p class="fw-bold fs-4 mb-0">${{ number_format($comprasMes, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----Clientes Nuevos--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-users fa-2x"></i>
                            <div class="mt-2">Clientes Nuevos</div>
                        </div>
                        <div class="col-4 text-end">
                            <p class="fw-bold fs-4 mb-0">{{ $clientesNuevos }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Gráfico de Tendencia de Ventas --}}
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Tendencia de Ventas (Últimos 12 Meses)
                </div>
                <div class="card-body"><canvas id="ventasAnualesChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        
        {{-- Gráfico de Ventas por Categoría --}}
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Ventas por Categoría
                </div>
                <div class="card-body"><canvas id="categoriasChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Top Productos --}}
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Top 5 Productos Más Vendidos (Periodo Seleccionado)
                </div>
                <div class="card-body"><canvas id="topProductosChart" width="100%" height="30"></canvas></div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script>
    // --- Gráfico de Ventas Anuales ---
    const ventasAnualesData = @json($ventasAnuales);
    const meses = ventasAnualesData.map(item => item.mes);
    const totalesAnuales = ventasAnualesData.map(item => item.total);

    new Chart(document.getElementById("ventasAnualesChart"), {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: "Ventas ($)",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: totalesAnuales,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: { unit: 'month' },
                    gridLines: { display: false },
                    ticks: { maxTicksLimit: 12 }
                }],
                yAxes: [{
                    ticks: { min: 0, maxTicksLimit: 5 },
                    gridLines: { color: "rgba(0, 0, 0, .125)" }
                }],
            },
            legend: { display: false }
        }
    });

    // --- Gráfico de Categorías ---
    const categoriasData = @json($ventasPorCategoria);
    const labelsCategorias = categoriasData.map(item => item.categoria);
    const dataCategorias = categoriasData.map(item => item.total);
    const backgroundColors = ['#007bff', '#dc3545', '#ffc107', '#28a745', '#17a2b8', '#6c757d'];

    new Chart(document.getElementById("categoriasChart"), {
        type: 'doughnut',
        data: {
            labels: labelsCategorias,
            datasets: [{
                data: dataCategorias,
                backgroundColor: backgroundColors,
            }],
        },
    });

    // --- Gráfico de Top Productos ---
    const topProductosData = @json($topProductos);
    const labelsProductos = topProductosData.map(item => item.nombre);
    const dataProductos = topProductosData.map(item => item.cantidad);

    new Chart(document.getElementById("topProductosChart"), {
        type: 'bar',
        data: {
            labels: labelsProductos,
            datasets: [{
                label: "Unidades Vendidas",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: dataProductos,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    gridLines: { display: false },
                    ticks: { maxTicksLimit: 6 }
                }],
                yAxes: [{
                    ticks: { min: 0, maxTicksLimit: 5 },
                    gridLines: { display: true }
                }],
            },
            legend: { display: false }
        }
    });
</script>
@endpush
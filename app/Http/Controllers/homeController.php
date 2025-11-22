<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index(): View
    {
        if (!Auth::check()) {
            return view('welcome');
        }

        // Filtros de fecha (por defecto mes actual)
        $fechaInicio = request('fecha_inicio') ?: Carbon::now()->startOfMonth()->format('Y-m-d');
        $fechaFin = request('fecha_fin') ?: Carbon::now()->endOfMonth()->format('Y-m-d');

        // KPIs
        $ventasHoy = DB::table('ventas')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

        $ventasMes = DB::table('ventas')
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->sum('total');

        $comprasMes = DB::table('compras')
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->sum('total');
        
        $clientesNuevos = DB::table('clientes')
            ->whereBetween('created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->count();

        // Gráfico: Ventas Anuales (Tendencia)
        $ventasAnuales = DB::table('ventas')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, SUM(total) as total")
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        // Gráfico: Ventas por Categoría
        $ventasPorCategoria = DB::table('producto_venta')
            ->join('productos', 'producto_venta.producto_id', '=', 'productos.id')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->join('caracteristicas', 'categorias.caracteristica_id', '=', 'caracteristicas.id')
            ->join('ventas', 'producto_venta.venta_id', '=', 'ventas.id')
            ->whereBetween('ventas.created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->selectRaw('caracteristicas.nombre as categoria, SUM(producto_venta.cantidad * producto_venta.precio_venta) as total')
            ->groupBy('caracteristicas.nombre')
            ->get();

        // Gráfico: Top 5 Productos más vendidos
        $topProductos = DB::table('producto_venta')
            ->join('productos', 'producto_venta.producto_id', '=', 'productos.id')
            ->join('ventas', 'producto_venta.venta_id', '=', 'ventas.id')
            ->whereBetween('ventas.created_at', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59'])
            ->selectRaw('productos.nombre, SUM(producto_venta.cantidad) as cantidad')
            ->groupBy('productos.nombre')
            ->orderByDesc('cantidad')
            ->limit(5)
            ->get();

        return view('panel.index', compact(
            'ventasHoy', 
            'ventasMes', 
            'comprasMes', 
            'clientesNuevos',
            'ventasAnuales',
            'ventasPorCategoria',
            'topProductos',
            'fechaInicio',
            'fechaFin'
        ));
    }
}

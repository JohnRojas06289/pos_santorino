<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'presentacione', 'inventario', 'kardex' => function($q) {
            $q->latest('id')->limit(1);
        }])
            ->where('estado', 1); // Solo productos activos

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtro por marca
        if ($request->filled('marca')) {
            $query->where('marca_id', $request->marca);
        }

        // Búsqueda por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Filtro por rango de precio
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::all();
        $marcas = Marca::all();

        return view('tienda.index', compact('productos', 'categorias', 'marcas'));
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'marca', 'presentacione', 'inventario', 'kardex' => function($q) {
            $q->latest('id')->limit(1);
        }])
            ->findOrFail($id);

        // Productos relacionados (misma categoría)
        $relacionados = Producto::with(['inventario', 'kardex' => function($q) {
            $q->latest('id')->limit(1);
        }])
            ->where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $producto->id)
            ->where('estado', 1)
            ->limit(4)
            ->get();

        return view('tienda.show', compact('producto', 'relacionados'));
    }

    public function about()
    {
        return view('tienda.about');
    }

    public function contact()
    {
        return view('tienda.contact');
    }
}

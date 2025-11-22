<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Presentacione;
use App\Models\Producto;
use App\Services\ActivityLogService;
use App\Services\ProductoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Models\ProductoMultimedia;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductoController extends Controller
{
    protected $productoService;

    function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|eliminar-producto', ['only' => ['index']]);
        $this->middleware('permission:crear-producto', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit', 'update', 'destroyMultimedia']]);
        $this->middleware('permission:eliminar-producto', ['only' => ['destroy']]);
    }

    public function destroyMultimedia($id)
    {
        try {
            $media = ProductoMultimedia::findOrFail($id);
            
            // Eliminar archivo del storage
            $path = str_replace('storage/', '', $media->ruta);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $media->delete();

            return back()->with('success', 'Archivo eliminado correctamente');
        } catch (Throwable $e) {
            Log::error('Error al eliminar multimedia', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error al eliminar el archivo');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Producto::with([
            'categoria.caracteristica',
            'marca.caracteristica',
            'presentacione.caracteristica',
            'inventario'
        ]);

        // Filtro por búsqueda
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('codigo', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        // Filtro por marca
        if (request()->filled('marca_id')) {
            $query->where('marca_id', request('marca_id'));
        }

        // Filtro por categoría
        if (request()->filled('categoria_id')) {
            $query->where('categoria_id', request('categoria_id'));
        }

        // Filtro por color
        if (request()->filled('color')) {
            $query->where('color', request('color'));
        }

        // Filtro por género
        if (request()->filled('genero')) {
            $query->where('genero', request('genero'));
        }

        // Filtro por estado
        if (request()->filled('estado')) {
            $query->where('estado', request('estado'));
        }

        // Ordenamiento
        $orderBy = request('order_by', 'created_at');
        $orderDir = request('order_dir', 'desc');

        switch ($orderBy) {
            case 'nombre':
                $query->orderBy('nombre', $orderDir);
                break;
            case 'precio':
                $query->orderBy('precio', $orderDir);
                break;
            case 'stock':
                $query->leftJoin('inventarios', 'productos.id', '=', 'inventarios.producto_id')
                      ->select('productos.*', 'inventarios.stock')
                      ->orderBy('inventarios.stock', $orderDir);
                break;
            default:
                $query->orderBy('created_at', $orderDir);
        }

        $productos = $query->paginate(12)->appends(request()->query());

        // Obtener datos para filtros
        $marcas = Marca::with('caracteristica')->get();
        $categorias = Categoria::with('caracteristica')->get();
        $colores = Producto::whereNotNull('color')->distinct()->pluck('color');

        return view('producto.index', compact('productos', 'marcas', 'categorias', 'colores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
            ->select('marcas.id as id', 'c.nombre as nombre')
            ->where('c.estado', 1)
            ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
            ->select('presentaciones.id as id', 'c.nombre as nombre')
            ->where('c.estado', 1)
            ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
            ->select('categorias.id as id', 'c.nombre as nombre')
            ->where('c.estado', 1)
            ->get();

        return view('producto.create', compact('marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request): RedirectResponse
    {
        try {
            $this->productoService->crearProducto($request->validated());
            ActivityLogService::log('Creación de producto', 'Productos', $request->validated());
            return redirect()->route('productos.index')->with('success', 'Producto registrado');
        } catch (Throwable $e) {
            Log::error('Error al crear el producto', ['error' => $e->getMessage()]);
            return redirect()->route('productos.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto): View
    {
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
            ->select('marcas.id as id', 'c.nombre as nombre')
            ->where('c.estado', 1)
            ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
            ->select('presentaciones.id as id', 'c.nombre as nombre')
            ->where('c.estado', 1)
            ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
            ->select('categorias.id as id', 'c.nombre as nombre')
            ->where('c.estado', 1)
            ->get();

        return view('producto.edit', compact('producto', 'marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto): RedirectResponse
    {
        try {
            $this->productoService->editarProducto($request->validated(), $producto);
            ActivityLogService::log('Edición de producto', 'Productos', $request->validated());
            return redirect()->route('productos.index')->with('success', 'Producto editado');
        } catch (Throwable $e) {
            Log::error('Error al editar el producto', ['error' => $e->getMessage()]);
            return redirect()->route('productos.index')->with('error', 'Ups, algo falló');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*
        $message = '';
        $producto = Producto::find($id);
        if ($producto->estado == 1) {
            Producto::where('id', $producto->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Producto eliminado';
        } else {
            Producto::where('id', $producto->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Producto restaurado';
        }

        return redirect()->route('productos.index')->with('success', $message);*/
    }
}

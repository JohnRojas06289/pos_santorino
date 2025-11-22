<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Mostrar el carrito de compras
     */
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        $productos = [];
        
        foreach ($carrito as $id => $item) {
            $producto = Producto::with('inventario')->find($id);
            if ($producto) {
                $item['producto'] = $producto;
                $item['subtotal'] = $item['cantidad'] * $item['precio'];
                $total += $item['subtotal'];
                $productos[$id] = $item;
            }
        }
        
        return view('tienda.carrito', compact('carrito', 'productos', 'total'));
    }

    /**
     * Agregar producto al carrito
     */
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        // Verificar stock disponible
        if (!$producto->tieneStock() || $producto->stock_real < $request->cantidad) {
            return redirect()->back()->with('error', 'Stock insuficiente para este producto');
        }

        $carrito = session()->get('carrito', []);
        
        // Si el producto ya está en el carrito, actualizar cantidad
        if (isset($carrito[$producto->id])) {
            $nuevaCantidad = $carrito[$producto->id]['cantidad'] + $request->cantidad;
            
            // Verificar que no exceda el stock
            if ($nuevaCantidad > $producto->stock_real) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible');
            }
            
            $carrito[$producto->id]['cantidad'] = $nuevaCantidad;
        } else {
            // Agregar nuevo producto al carrito
            $carrito[$producto->id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $request->cantidad,
                'imagen' => $producto->img_path
            ];
        }
        
        session()->put('carrito', $carrito);
        
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Actualizar cantidad de un producto en el carrito
     */
    public function actualizar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $id = $request->producto_id;
        $carrito = session()->get('carrito', []);
        
        if (!isset($carrito[$id])) {
            return redirect()->route('carrito.index')->with('error', 'Producto no encontrado en el carrito');
        }
        
        $producto = Producto::find($id);
        
        if (!$producto || $request->cantidad > $producto->stock_real) {
            return redirect()->route('carrito.index')->with('error', 'Stock insuficiente');
        }
        
        $carrito[$id]['cantidad'] = $request->cantidad;
        session()->put('carrito', $carrito);
        
        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado');
    }

    /**
     * Eliminar producto del carrito
     */
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Vaciar el carrito completo
     */
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado');
    }
}

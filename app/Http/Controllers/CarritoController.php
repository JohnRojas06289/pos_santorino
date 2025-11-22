<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('tienda.carrito', compact('carrito', 'total'));
    }

    public function agregar(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, aumentar cantidad
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $request->cantidad;
        } else {
            // Agregar nuevo producto al carrito
            $carrito[$producto->id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $request->cantidad,
                'imagen' => $producto->img_path,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function actualizar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$request->producto_id])) {
            $carrito[$request->producto_id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado');
    }
}

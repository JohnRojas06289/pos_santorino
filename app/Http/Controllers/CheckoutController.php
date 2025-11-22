<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('tienda.index')->with('error', 'Tu carrito está vacío');
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('tienda.checkout', compact('carrito', 'total'));
    }

    public function procesar(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'direccion_envio' => 'required|string',
            'ciudad' => 'required|string',
            'codigo_postal' => 'nullable|string',
            'metodo_pago' => 'required|string',
        ]);

        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('tienda.index')->with('error', 'Tu carrito está vacío');
        }

        DB::beginTransaction();

        try {
            // Calcular total
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // Crear pedido
            $pedido = Pedido::create([
                'nombre_cliente' => $request->nombre_cliente,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion_envio' => $request->direccion_envio,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'total' => $total,
                'metodo_pago' => $request->metodo_pago,
                'notas' => $request->notas,
                'estado' => 'pendiente',
            ]);

            // Agregar productos al pedido
            foreach ($carrito as $producto_id => $item) {
                PedidoProducto::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto_id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal' => $item['precio'] * $item['cantidad'],
                ]);
            }

            DB::commit();

            // Vaciar carrito
            session()->forget('carrito');

            return redirect()->route('checkout.confirmacion', $pedido->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un error al procesar tu pedido. Inténtalo de nuevo.');
        }
    }

    public function confirmacion($id)
    {
        $pedido = Pedido::with('productos.producto')->findOrFail($id);
        return view('tienda.confirmacion', compact('pedido'));
    }
}

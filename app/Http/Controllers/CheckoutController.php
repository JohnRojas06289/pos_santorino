<?php

namespace App\Http\Controllers;

use App\Models\PedidoOnline;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\TipoTransaccionEnum;

class CheckoutController extends Controller
{
    /**
     * Mostrar formulario de checkout
     */
    public function index()
    {
        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('tienda.index')->with('error', 'Tu carrito está vacío');
        }
        
        $total = 0;
        $productos = [];
        
        foreach ($carrito as $id => $item) {
            $producto = Producto::find($id);
            if ($producto) {
                $item['producto'] = $producto;
                $item['subtotal'] = $item['cantidad'] * $item['precio'];
                $total += $item['subtotal'];
                $productos[$id] = $item;
            }
        }
        
        $subtotal = $total;
        $impuestos = $total * 0.19; // IVA 19%
        $envio = 0; // Por ahora sin costo de envío
        $total = $subtotal + $impuestos + $envio;
        
        return view('tienda.checkout', compact('productos', 'subtotal', 'impuestos', 'envio', 'total'));
    }

    /**
     * Procesar el pedido
     */
    public function procesar(Request $request)
    {
        \Log::info('Iniciando procesamiento de pedido', $request->all());

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'ciudad' => 'required|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'codigo_postal' => 'nullable|string|max:10',
            'metodo_pago' => 'required|string|in:efectivo,transferencia,pse,tarjeta',
            'notas' => 'nullable|string',
        ]);

        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('tienda.index')->with('error', 'Tu carrito está vacío');
        }

        DB::beginTransaction();
        
        try {
            // Calcular totales
            $subtotal = 0;
            foreach ($carrito as $id => $item) {
                $subtotal += $item['cantidad'] * $item['precio'];
            }
            
            $impuestos = $subtotal * 0.19;
            $envio = 0;
            $total = $subtotal + $impuestos + $envio;
            
            // Crear el pedido
            $pedido = PedidoOnline::create([
                'cliente_nombre' => $request->nombre,
                'cliente_email' => $request->email,
                'cliente_telefono' => $request->telefono,
                'cliente_direccion' => $request->direccion,
                'cliente_ciudad' => $request->ciudad,
                'cliente_departamento' => $request->departamento,
                'cliente_codigo_postal' => $request->codigo_postal,
                'subtotal' => $subtotal,
                'impuestos' => $impuestos,
                'envio' => $envio,
                'total' => $total,
                'metodo_pago' => $request->metodo_pago,
                'notas' => $request->notas,
                'estado' => 'pendiente',
            ]);
            
            // Procesar productos y descontar inventario
            foreach ($carrito as $id => $item) {
                $producto = Producto::with('inventario')->find($id);
                
                // Verificar stock disponible
                if (!$producto || !$producto->tieneStock() || $producto->stock_real < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para {$item['nombre']}");
                }
                
                // Adjuntar al pedido
                $pedido->productos()->attach($id, [
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal' => $item['cantidad'] * $item['precio'],
                ]);

                // Descontar del inventario
                $inventario = $producto->inventario;
                if ($inventario) {
                    $inventario->cantidad -= $item['cantidad'];
                    $inventario->save();
                    


                    // Registrar en Kardex
                    \App\Models\Kardex::create([
                        'producto_id' => $producto->id,
                        'tipo_transaccion' => TipoTransaccionEnum::Venta,
                        'descripcion_transaccion' => 'Venta Online - Pedido #' . $pedido->numero_pedido,
                        'salida' => $item['cantidad'],
                        'entrada' => 0,
                        'saldo' => $inventario->cantidad,
                        'costo_unitario' => $producto->precio,
                    ]);
                }
            }
            
            DB::commit();
            \Log::info('Pedido creado exitosamente: ' . $pedido->id);
            
            // Vaciar el carrito
            session()->forget('carrito');
            
            return redirect()->route('pedido.confirmacion', $pedido->id)
                ->with('success', '¡Pedido realizado exitosamente!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en checkout: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar confirmación del pedido
     */
    public function confirmacion($id)
    {
        $pedido = PedidoOnline::with('productos')->findOrFail($id);
        
        return view('tienda.confirmacion', compact('pedido'));
    }
}

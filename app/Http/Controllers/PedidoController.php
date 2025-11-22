<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('productos')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('pedido.index', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::with(['productos.producto', 'venta'])->findOrFail($id);
        return view('pedido.show', compact('pedido'));
    }

    public function actualizar(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        
        $pedido->update([
            'estado' => $request->estado,
        ]);

        return redirect()->back()->with('success', 'Estado del pedido actualizado');
    }

    public function convertirAVenta($id)
    {
        $pedido = Pedido::with('productos.producto')->findOrFail($id);

        if ($pedido->venta_id) {
            return redirect()->back()->with('error', 'Este pedido ya fue procesado como venta');
        }

        DB::beginTransaction();

        try {
            // Buscar o crear cliente
            $cliente = Cliente::where('email', $pedido->email)->first();
            
            if (!$cliente) {
                // Crear nuevo cliente
                $persona = \App\Models\Persona::create([
                    'razon_social' => $pedido->nombre_cliente,
                    'direccion' => $pedido->direccion_envio,
                    'tipo_persona' => 'natural',
                ]);

                $cliente = Cliente::create([
                    'persona_id' => $persona->id,
                ]);
            }

            // Crear venta
            $venta = Venta::create([
                'fecha_hora' => now(),
                'impuesto' => 0,
                'total' => $pedido->total,
                'estado' => 1,
                'cliente_id' => $cliente->id,
                'user_id' => auth()->id(),
                'comprobante_id' => 1, // Ajustar según tu sistema
            ]);

            // Agregar productos a la venta
            foreach ($pedido->productos as $item) {
                $venta->productos()->attach($item->producto_id, [
                    'cantidad' => $item->cantidad,
                    'precio_venta' => $item->precio_unitario,
                ]);

                // Actualizar inventario
                $inventario = $item->producto->inventario;
                if ($inventario) {
                    $inventario->decrement('stock', $item->cantidad);
                }
            }

            // Vincular pedido con venta
            $pedido->update([
                'venta_id' => $venta->id,
                'estado' => 'procesando',
            ]);

            DB::commit();

            return redirect()->route('pedidos.show', $pedido->id)
                ->with('success', 'Pedido procesado como venta exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
}

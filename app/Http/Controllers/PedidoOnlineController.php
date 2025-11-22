<?php

namespace App\Http\Controllers;

use App\Models\PedidoOnline;
use Illuminate\Http\Request;

class PedidoOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PedidoOnline::with('productos')->recientes();
        
        // Filtrar por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        
        // Buscar por número de pedido o cliente
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('numero_pedido', 'like', "%{$buscar}%")
                  ->orWhere('cliente_nombre', 'like', "%{$buscar}%")
                  ->orWhere('cliente_email', 'like', "%{$buscar}%");
            });
        }
        
        // Filtrar por rango de fechas
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
        
        $pedidos = $query->paginate(15);
        
        // Contar pedidos por estado
        $estadisticas = [
            'pendientes' => PedidoOnline::where('estado', 'pendiente')->count(),
            'confirmados' => PedidoOnline::where('estado', 'confirmado')->count(),
            'preparando' => PedidoOnline::where('estado', 'preparando')->count(),
            'enviados' => PedidoOnline::where('estado', 'enviado')->count(),
            'entregados' => PedidoOnline::where('estado', 'entregado')->count(),
            'cancelados' => PedidoOnline::where('estado', 'cancelado')->count(),
        ];
        
        return view('pedidos-online.index', compact('pedidos', 'estadisticas'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedido = PedidoOnline::with(['productos', 'venta'])->findOrFail($id);
        
        return view('pedidos-online.show', compact('pedido'));
    }

    /**
     * Actualizar estado del pedido
     */
    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmado,preparando,enviado,entregado,cancelado',
            'notas_admin' => 'nullable|string',
        ]);

        $pedido = PedidoOnline::findOrFail($id);
        $estadoAnterior = $pedido->estado;
        $nuevoEstado = $request->estado;
        
        try {
            // Si se está confirmando el pedido
            if ($estadoAnterior === 'pendiente' && $nuevoEstado === 'confirmado') {
                $pedido->confirmar();
                $mensaje = 'Pedido confirmado e inventario actualizado';
            }
            // Si se está cancelando
            elseif ($nuevoEstado === 'cancelado') {
                $pedido->cancelar();
                $mensaje = 'Pedido cancelado';
                if ($estadoAnterior === 'confirmado') {
                    $mensaje .= ' y stock devuelto';
                }
            }
            // Otros cambios de estado
            else {
                $pedido->estado = $nuevoEstado;
                $pedido->save();
                $mensaje = 'Estado actualizado correctamente';
            }
            
            // Actualizar notas del admin si se proporcionaron
            if ($request->filled('notas_admin')) {
                $pedido->notas_admin = $request->notas_admin;
                $pedido->save();
            }
            
            return redirect()->route('pedidos-online.show', $pedido->id)
                ->with('success', $mensaje);
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar estado: ' . $e->getMessage());
        }
    }

    /**
     * Convertir pedido en venta del sistema
     */
    public function convertirAVenta($id)
    {
        $pedido = PedidoOnline::with('productos')->findOrFail($id);
        
        if ($pedido->estado !== 'confirmado') {
            return redirect()->back()
                ->with('error', 'Solo se pueden convertir pedidos confirmados');
        }
        
        if ($pedido->venta_id) {
            return redirect()->back()
                ->with('error', 'Este pedido ya fue convertido en venta');
        }
        
        try {
            \DB::beginTransaction();
            
            // Crear la venta
            $venta = \App\Models\Venta::create([
                'fecha_hora' => now(),
                'impuesto' => $pedido->impuestos,
                'total' => $pedido->total,
                'estado' => 1,
                'user_id' => auth()->id(),
                'cliente_id' => null, // O buscar/crear cliente por email
                'comprobante_id' => 1, // Ajustar según tu sistema
            ]);
            
            // Agregar productos a la venta
            foreach ($pedido->productos as $producto) {
                $venta->productos()->attach($producto->id, [
                    'cantidad' => $producto->pivot->cantidad,
                    'precio_venta' => $producto->pivot->precio_unitario,
                ]);
            }
            
            // Vincular pedido con venta
            $pedido->venta_id = $venta->id;
            $pedido->save();
            
            \DB::commit();
            
            return redirect()->route('pedidos-online.show', $pedido->id)
                ->with('success', 'Pedido convertido en venta #' . $venta->id);
                
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al convertir en venta: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pedido = PedidoOnline::findOrFail($id);
        
        // Solo permitir eliminar pedidos cancelados
        if ($pedido->estado !== 'cancelado') {
            return redirect()->back()
                ->with('error', 'Solo se pueden eliminar pedidos cancelados');
        }
        
        $pedido->delete();
        
        return redirect()->route('pedidos-online.index')
            ->with('success', 'Pedido eliminado correctamente');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PedidoOnline extends Model
{
    use HasFactory;

    protected $table = 'pedidos_online';

    protected $guarded = ['id'];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'impuestos' => 'decimal:2',
        'envio' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Relación con productos
     */
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'pedido_online_producto')
            ->withPivot('cantidad', 'precio_unitario', 'subtotal')
            ->withTimestamps();
    }

    /**
     * Relación con venta (cuando se convierte)
     */
    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class);
    }

    /**
     * Boot del modelo
     */
    protected static function booted()
    {
        static::creating(function ($pedido) {
            if (empty($pedido->numero_pedido)) {
                $pedido->numero_pedido = self::generarNumeroPedido();
            }
        });
    }

    /**
     * Generar número de pedido único
     */
    public static function generarNumeroPedido(): string
    {
        $fecha = now()->format('Ymd');
        $ultimo = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();
        
        $consecutivo = $ultimo ? (int)substr($ultimo->numero_pedido, -4) + 1 : 1;
        
        return 'PO-' . $fecha . '-' . str_pad($consecutivo, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Calcular totales del pedido
     */
    public function calcularTotales(): void
    {
        $subtotal = 0;
        
        foreach ($this->productos as $producto) {
            $subtotal += $producto->pivot->subtotal;
        }
        
        $this->subtotal = $subtotal;
        $this->impuestos = $subtotal * 0.19; // IVA 19%
        $this->total = $this->subtotal + $this->impuestos + $this->envio;
    }

    /**
     * Confirmar pedido y descontar inventario
     */
    public function confirmar(): bool
    {
        if ($this->estado !== 'pendiente') {
            return false;
        }

        \DB::beginTransaction();
        
        try {
            // Ya no descontamos inventario aquí porque se hizo al crear el pedido
            // Solo actualizamos el estado
            
            $this->estado = 'confirmado';
            $this->save();
            
            \DB::commit();
            return true;
            
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Cancelar pedido y devolver stock si estaba confirmado
     */
    public function cancelar(): bool
    {
        if (in_array($this->estado, ['entregado', 'cancelado'])) {
            return false;
        }

        \DB::beginTransaction();
        
        try {
            // Si estaba confirmado, devolver stock
            if ($this->estado === 'confirmado') {
                foreach ($this->productos as $producto) {
                    $cantidad = $producto->pivot->cantidad;
                    
                    $inventario = $producto->inventario;
                    if ($inventario) {
                        $inventario->cantidad += $cantidad;
                        $inventario->save();
                    }
                    
                    // Registrar en Kardex
                    Kardex::create([
                        'producto_id' => $producto->id,
                        'tipo_movimiento' => 'entrada',
                        'cantidad' => $cantidad,
                        'motivo' => 'Cancelación Pedido Online #' . $this->numero_pedido,
                        'saldo' => $inventario ? $inventario->cantidad : 0,
                    ]);
                }
            }
            
            $this->estado = 'cancelado';
            $this->save();
            
            \DB::commit();
            return true;
            
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Accessor para estado en español
     */
    public function getEstadoTextoAttribute(): string
    {
        $estados = [
            'pendiente' => 'Pendiente',
            'confirmado' => 'Confirmado',
            'preparando' => 'Preparando',
            'enviado' => 'Enviado',
            'entregado' => 'Entregado',
            'cancelado' => 'Cancelado',
        ];
        
        return $estados[$this->estado] ?? $this->estado;
    }

    /**
     * Accessor para color del badge según estado
     */
    public function getEstadoColorAttribute(): string
    {
        $colores = [
            'pendiente' => 'warning',
            'confirmado' => 'info',
            'preparando' => 'primary',
            'enviado' => 'secondary',
            'entregado' => 'success',
            'cancelado' => 'danger',
        ];
        
        return $colores[$this->estado] ?? 'secondary';
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope para pedidos pendientes
     */
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    /**
     * Scope para pedidos recientes
     */
    public function scopeRecientes($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

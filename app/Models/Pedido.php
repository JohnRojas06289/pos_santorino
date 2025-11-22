<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class);
    }

    public function productos(): HasMany
    {
        return $this->hasMany(PedidoProducto::class);
    }

    public function getTotalProductosAttribute(): int
    {
        return $this->productos->sum('cantidad');
    }

    public function getEstadoBadgeAttribute(): string
    {
        return match($this->estado) {
            'pendiente' => 'warning',
            'confirmado' => 'info',
            'procesando' => 'primary',
            'enviado' => 'secondary',
            'entregado' => 'success',
            'cancelado' => 'danger',
            default => 'secondary'
        };
    }
}

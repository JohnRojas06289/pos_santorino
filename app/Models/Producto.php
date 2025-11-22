<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_compra', 'fecha_vencimiento');
    }

    public function ventas(): BelongsToMany
    {
        return $this->belongsToMany(Venta::class)
            ->withTimestamps()
            ->withPivot('cantidad', 'precio_venta');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function presentacione(): BelongsTo
    {
        return $this->belongsTo(Presentacione::class);
    }

    public function inventario(): HasOne
    {
        return $this->hasOne(Inventario::class);
    }

    public function multimedia(): HasMany
    {
        return $this->hasMany(ProductoMultimedia::class);
    }

    public function kardex(): HasMany
    {
        return $this->hasMany(Kardex::class);
    }

    protected static function booted()
    {
        static::creating(function ($producto) {
            //Si no se propociona un código, generar uno único
            if (empty($producto->codigo)) {
                $producto->codigo = self::generateUniqueCode();
            }
        });
    }

    /**
     * Genera un código único para el producto
     */
    private static function generateUniqueCode(): string
    {
        do {
            $code = str_pad(random_int(0, 9999999999), 12, '0', STR_PAD_LEFT);
        } while (self::where('codigo', $code)->exists());

        return $code;
    }

    /**
     * Accesor para obtener el código, nombre y presentación del producto
     */
    public function getNombreCompletoAttribute(): string
    {
        return "Código: {$this->codigo} - {$this->nombre} - Presentación: {$this->presentacione->sigla}";
    }

    /**
     * Obtener el stock real del producto desde el Kardex
     * Si no hay registro en Kardex, intenta obtenerlo del inventario
     */
    public function getStockRealAttribute(): int
    {
        // Primero intenta obtener el stock del Kardex (más preciso)
        // Si ya está cargado en la relación, úsalo directamente
        if ($this->relationLoaded('kardex') && $this->kardex->isNotEmpty()) {
            $ultimoKardex = $this->kardex->first();
            if ($ultimoKardex && isset($ultimoKardex->saldo)) {
                return (int) $ultimoKardex->saldo;
            }
        }
        
        // Si no está cargado, consulta directamente
        $ultimoKardex = $this->kardex()->latest('id')->first();
        if ($ultimoKardex && isset($ultimoKardex->saldo)) {
            return (int) $ultimoKardex->saldo;
        }

        // Si no hay Kardex, intenta obtenerlo del inventario
        // Usar relationLoaded para evitar consultas adicionales si ya está cargado
        if ($this->relationLoaded('inventario') && $this->inventario) {
            return (int) ($this->inventario->cantidad ?? 0);
        }
        
        // Si no está cargado, consulta directamente
        $inventario = $this->inventario;
        if ($inventario) {
            return (int) ($inventario->cantidad ?? 0);
        }

        return 0;
    }

    /**
     * Verificar si el producto tiene stock disponible
     */
    public function tieneStock(): bool
    {
        return $this->stock_real > 0;
    }
}

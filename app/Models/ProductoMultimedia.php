<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoMultimedia extends Model
{
    use HasFactory;

    protected $table = 'producto_multimedia';

    protected $fillable = [
        'producto_id',
        'ruta',
        'tipo',
        'orden'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

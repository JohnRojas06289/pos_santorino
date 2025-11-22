<?php

use App\Models\Producto;

echo "=== DIAGNÓSTICO DE STOCK ===" . PHP_EOL . PHP_EOL;

echo "Total productos: " . Producto::count() . PHP_EOL;
echo "Productos con inventario: " . Producto::has('inventario')->count() . PHP_EOL;
echo "Productos con stock > 0: " . Producto::whereHas('inventario', function($q) { 
    $q->where('cantidad', '>', 0); 
})->count() . PHP_EOL . PHP_EOL;

$producto = Producto::with('inventario', 'kardex')->first();
if ($producto) {
    echo "--- Primer producto ---" . PHP_EOL;
    echo "Nombre: " . $producto->nombre . PHP_EOL;
    echo "Tiene inventario: " . ($producto->inventario ? 'SI' : 'NO') . PHP_EOL;
    
    if ($producto->inventario) {
        echo "Cantidad en inventario: " . $producto->inventario->cantidad . PHP_EOL;
    }
    
    echo "Stock real (accessor): " . $producto->stock_real . PHP_EOL;
    echo "Tiene stock (método): " . ($producto->tieneStock() ? 'SI' : 'NO') . PHP_EOL . PHP_EOL;
}

// Mostrar primeros 5 productos con sus stocks
echo "--- Primeros 5 productos ---" . PHP_EOL;
$productos = Producto::with('inventario', 'kardex')->limit(5)->get();
foreach ($productos as $p) {
    echo sprintf(
        "ID: %d | %s | Inventario: %s | Stock: %d | Tiene stock: %s" . PHP_EOL,
        $p->id,
        $p->nombre,
        $p->inventario ? 'SI' : 'NO',
        $p->stock_real,
        $p->tieneStock() ? 'SI' : 'NO'
    );
}

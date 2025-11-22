<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos_online', function (Blueprint $table) {
            $table->id();
            $table->string('numero_pedido', 20)->unique();
            
            // Información del cliente
            $table->string('cliente_nombre');
            $table->string('cliente_email');
            $table->string('cliente_telefono', 20);
            $table->text('cliente_direccion');
            $table->string('cliente_ciudad', 100);
            $table->string('cliente_departamento', 100)->nullable();
            $table->string('cliente_codigo_postal', 10)->nullable();
            
            // Totales
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impuestos', 10, 2)->default(0);
            $table->decimal('envio', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            
            // Estado y método de pago
            $table->enum('estado', ['pendiente', 'confirmado', 'preparando', 'enviado', 'entregado', 'cancelado'])->default('pendiente');
            $table->string('metodo_pago', 50)->default('efectivo');
            
            // Notas
            $table->text('notas')->nullable();
            $table->text('notas_admin')->nullable();
            
            // Relación con venta (cuando se convierte)
            $table->foreignId('venta_id')->nullable()->constrained('ventas')->nullOnDelete();
            
            $table->timestamps();
            
            // Índices para búsquedas
            $table->index('numero_pedido');
            $table->index('estado');
            $table->index('cliente_email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_online');
    }
};

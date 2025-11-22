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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nombre_cliente');
            $table->string('email');
            $table->string('telefono');
            $table->text('direccion_envio');
            $table->string('ciudad');
            $table->string('codigo_postal')->nullable();
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['pendiente', 'confirmado', 'procesando', 'enviado', 'entregado', 'cancelado'])->default('pendiente');
            $table->string('metodo_pago')->default('transferencia');
            $table->text('notas')->nullable();
            $table->foreignId('venta_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

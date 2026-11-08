<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            // Información del cliente
            $table->string('nombre', 150);
            $table->string('documento', 20)->nullable()->unique();
            $table->string('telefono', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('direccion')->nullable();

            // Estado
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

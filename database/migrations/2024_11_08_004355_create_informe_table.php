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
        Schema::create('informe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrada_id');
            $table->unsignedBigInteger('salida_id');
            $table->date('fecha_informe');
            $table->timestamps();

            // Definir llave foránea de entrada
            $table->foreign('entrada_id')
                ->references('id')
                ->on('entrada')
                ->onDelete('no action');

            // Definir llave foránea de salida
            $table->foreign('salida_id')
                ->references('id')
                ->on('salida')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informe');
    }
};

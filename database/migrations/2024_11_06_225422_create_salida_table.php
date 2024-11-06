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
        Schema::create('salida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prducto_id');
            $table->date('fecha_salida');
            $table->string('motivo', 255)->nullable();
            $table->integer('cantidad');
            $table->timestamps();

            // Definir llave foranea
            $table->foreign('prducto_id')
                ->references('id')
                ->on('producto')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salida');
    }
};

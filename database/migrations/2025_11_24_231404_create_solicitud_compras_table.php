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
        Schema::create('solicitud_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_solicitud');
            $table->string('motivo_solicitud');
            $table->unsignedBiginteger('personals_id')->nullable();
            $table->foreign('personals_id')->references('id')->on('personals')->nullable()->constrained()->onUpdate('cascade');
            $table->string('equipo_solicitado');
            $table->string('nivel_prioridad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_compras');
    }
};

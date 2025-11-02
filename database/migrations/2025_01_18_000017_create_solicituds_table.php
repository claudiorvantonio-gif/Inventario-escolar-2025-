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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            $table->integer('tipo_solicitud')->default(1);
            $table->unsignedBiginteger('equipos_id')->nullable();
            $table->foreign('equipos_id')->references('id')->on('equipos')->nullable()->constrained()->onUpdate('cascade');
            $table->integer('estado')->default(1);
            $table->date('fecha_solicitud');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};

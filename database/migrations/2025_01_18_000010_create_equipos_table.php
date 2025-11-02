<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('numero_serial');
            $table->string('modelo');
            $table->string('marca');
            $table->string('color');
            $table->string('descripcion');
            $table->unsignedBiginteger('categorias_id')->nullable();
            $table->foreign('categorias_id')->references('id')->on('categorias')->nullable()->constrained()->onUpdate('cascade');
            $table->unsignedBiginteger('salas_id')->nullable();
            $table->foreign('salas_id')->references('id')->on('salas')->nullable()->constrained()->onUpdate('cascade');
            $table->unsignedBiginteger('personals_id')->nullable();
            $table->foreign('personals_id')->references('id')->on('personals')->nullable()->constrained()->onUpdate('cascade');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};

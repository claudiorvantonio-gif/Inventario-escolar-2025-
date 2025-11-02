<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adquisicions', function (Blueprint $table) {
            $table->id();
            $table->string('monto');
            $table->foreignId('financiamientos_id')->constrained('financiamientos')->onDelete('cascade');
            $table->foreignId('equipos_id')->constrained('equipos')->onDelete('cascade');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adquisicions');
    }
};

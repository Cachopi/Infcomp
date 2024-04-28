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
        Schema::create('cursos_factura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cursos_id')->constrained()->onDelete('cascade');
            $table->foreignId('factura_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad')->nullable(); // Puedes ajustar esto según tus necesidades
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_cursos');
    }
};

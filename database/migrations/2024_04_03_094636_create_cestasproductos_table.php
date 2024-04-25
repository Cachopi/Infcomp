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
        Schema::create('cestas_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cesta_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad')->default(1);
            $table->foreign('cesta_id')->references('id')->on('cestas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cestas_productos');
    }
};

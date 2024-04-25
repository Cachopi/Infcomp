<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cesta_cursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id');
            $table->unsignedBigInteger('cesta_id');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('cesta_id')->references('id')->on('cestas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cesta_cursos');
    }
};

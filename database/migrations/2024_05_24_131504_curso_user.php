<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('cursos_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('curso_id')->constrained()->onDelete('cascade');
            $table->integer('progreso')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos_user');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_academicos', function (Blueprint $table) {
            $table->id();
            $table->enum('grado', ['estudiante','tecnico superior','licenciado','ingeniero','magister','doctor']);
            $table->string('profesion')->nullable();
            $table->string('universidad');
            $table->string('carrera');
            $table->foreignId('estudiante_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado_academicos');
    }
}

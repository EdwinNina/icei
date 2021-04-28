<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnterioresEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anteriores_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('carnet',10)->nullable();
            $table->string('paterno',50)->nullable();
            $table->string('materno',50)->nullable();
            $table->string('nombre',70);
            $table->string('carrera',70);
            $table->string('modulo',5);
            $table->string('nota',3);
            $table->string('docente',50);
            $table->string('fecha_inicio',20);
            $table->string('fecha_fin',20);
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
        Schema::dropIfExists('anteriores_estudiantes');
    }
}

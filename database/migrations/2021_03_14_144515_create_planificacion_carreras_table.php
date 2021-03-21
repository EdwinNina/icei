<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificacionCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificacion_carreras', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->integer('costo_carrera')->length(6);
            $table->integer('costo_modulo')->length(6);
            $table->string('gestion',5);
            $table->string('estado',2)->default(1);
            $table->foreignId('carrera_id')->constrained();
            $table->foreignId('modalidad_id')->constrained();
            $table->foreignId('horario_id')->constrained();
            $table->foreignId('docente_id')->constrained();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('planificacion_carreras');
    }
}

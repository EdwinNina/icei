<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificacionTallersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificacion_tallers', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('costo',8,2);
            $table->string('duracion');
            $table->string('carga_horaria',10);
            $table->string('requisitos');
            $table->foreignId('modalidad_id')->constrained();
            $table->foreignId('docente_id')->constrained();
            $table->foreignId('horario_id')->constrained();
            $table->foreignId('taller_id')->constrained();
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('planificacion_tallers');
    }
}

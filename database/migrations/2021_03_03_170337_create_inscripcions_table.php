<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')->constrained();
            $table->foreignId('modulo_id')->constrained();
            $table->foreignId('planificacion_carrera_id')->constrained();
            $table->foreignId('tipo_pago_id')->constrained();
            $table->foreignId('tipo_plan_pago_id')->constrained();
            $table->enum('actividad',['escuela','colegio','universidad','empresa','independiente']);
            $table->string('estado', 2)->default(1);
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
        Schema::dropIfExists('inscripcions');
    }
}

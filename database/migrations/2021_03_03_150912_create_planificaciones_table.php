<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->enum('modalidad',['presencial','semi-presencial','virtual']);
            $table->integer('costo_carrera')->length(6);
            $table->integer('costo_modulo')->length(6);
            $table->string('gestion',5);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('carrera_id')->constrained();
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
        Schema::dropIfExists('planificaciones');
    }
}

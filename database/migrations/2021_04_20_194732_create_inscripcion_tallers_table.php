<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionTallersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion_tallers', function (Blueprint $table) {
            $table->id();
            $table->boolean('certificado_habilitado')->default(0);
            $table->decimal('total_costo',8,2);
            $table->decimal('total_pagado',8,2);
            $table->decimal('saldo',8,2);
            $table->foreignId('estudiante_id')->constrained();
            $table->foreignId('planificacion_taller_id')->constrained();
            $table->string('estado', 1)->default(1);
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
        Schema::dropIfExists('inscripcion_tallers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_carreras', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_certificado',8,2);
            $table->decimal('total_pagado',8,2)->nullable();
            $table->decimal('saldo',8,2)->nullable();
            $table->boolean('solicitado')->default(0);
            $table->date('fecha_solicitado')->nullable();
            $table->boolean('impresion')->default(0);
            $table->date('fecha_impresion')->nullable();
            $table->boolean('entregado')->default(0);
            $table->date('fecha_entregado')->nullable();
            $table->string('entregado_a', 255)->nullable();
            $table->boolean('fotos')->default(0);
            $table->boolean('estado')->default(0);
            $table->foreignId('estudiante_id')->constrained();
            $table->foreignId('carrera_id')->constrained();
            $table->foreignId('planificacion_carrera_id')->constrained();
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
        Schema::dropIfExists('certificado_carreras');
    }
}

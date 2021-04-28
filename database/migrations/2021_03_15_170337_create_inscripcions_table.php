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
            $table->foreignId('tipo_plan_pago_id')->constrained();
            $table->decimal('total_modulo',8,2);
            $table->decimal('total_pagado',8,2);
            $table->decimal('saldo',8,2);
            $table->boolean('habilitado_2t')->default(0);
            $table->decimal('total_monto_2t',8,2)->nullable();
            $table->date('fecha_habilitado_2t')->nullable();
            $table->decimal('saldo_examen',8,2)->nullable();;
            $table->boolean('habilitado_certificado')->default(0);
            $table->decimal('total_monto_certificado',8,2)->nullable();
            $table->date('fecha_habilitado_certificado')->nullable();
            $table->decimal('saldo_certificado',8,2)->nullable();;
            $table->boolean('congelacion')->default(0);
            $table->date('fecha_congelacion_inicio')->nullable();
            $table->date('fecha_congelacion_fin')->nullable();
            $table->enum('actividad',['escuela','colegio','universidad','empresa','independiente']);
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
        Schema::dropIfExists('inscripcions');
    }
}

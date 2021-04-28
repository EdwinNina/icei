<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50)->nullable();
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
            $table->foreignId('planificacion_modulo_id')->constrained();
            $table->foreignId('nota_id')->constrained();
            $table->foreignId('inscripcion_id')->constrained();
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
        Schema::dropIfExists('certificados');
    }
}

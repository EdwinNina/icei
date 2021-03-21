<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionEconomicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion_economicos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_recibo')->nullable();
            $table->integer('monto')->length('15');
            $table->string('boleta')->nullable();
            $table->date('fecha_pago');
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
        Schema::dropIfExists('inscripcion_economicos');
    }
}

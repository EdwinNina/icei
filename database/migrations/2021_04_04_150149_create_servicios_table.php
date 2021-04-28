<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_recepcion');
            $table->date('fecha_entrega');
            $table->text('detalles');
            $table->decimal('monto',8,2);
            $table->decimal('saldo',8,2)->nullable();
            $table->foreignId('categoria_servicio_id')->constrained();
            $table->foreignId('estudiante_id')->constrained();
            $table->foreignId('docente_id')->constrained();
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
        Schema::dropIfExists('servicios');
    }
}

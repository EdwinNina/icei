<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroEconomicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_economicos', function (Blueprint $table) {
            $table->id();
            $table->string('numeroFactura',100)->nullable();
            $table->enum('concepto',['reserva','adelanto','cancelacionTotal']);
            $table->string('numero_recibo')->nullable();
            $table->decimal('monto',8,2);
            $table->date('fecha_pago');
            $table->string('estado',2);
            $table->morphs('economicable');
            $table->foreignId('tipo_razon_id')->constrained();
            $table->foreignId('tipo_pago_id')->constrained();
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
        Schema::dropIfExists('registro_economicos');
    }
}

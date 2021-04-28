<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('nota_1',2)->default('0')->nullable();
            $table->string('nota_2',2)->default('0')->nullable();
            $table->string('nota_final',3)->default('0')->nullable();
            $table->string('estado',2)->default('2')->nullable();
            $table->foreignId('estudiante_id')->constrained();
            $table->foreignId('planificacion_modulo_id')->constrained();
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
        Schema::dropIfExists('notas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('carnet')->length(15)->unique();
            $table->string('expedido', 2);
            $table->string('nombre',50);
            $table->string('paterno',50);
            $table->string('materno',50);
            $table->string('codigo',20);
            $table->string('email',30);
            $table->integer('celular')->length(8);
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
        Schema::dropIfExists('estudiantes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_docentes', function (Blueprint $table) {
            $table->id();
            $table->string('profesion')->nullable();
            $table->text('biografia')->nullable();
            $table->string('website')->nullable();
            $table->string('foto')->nullable();
            $table->string('curriculum')->nullable();
            $table->foreignId('docente_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('perfil_docentes');
    }
}

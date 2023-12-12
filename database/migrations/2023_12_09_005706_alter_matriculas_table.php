<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('matriculas', function(Blueprint $table){
            $table->foreign('idEstudiante')->references('idEstudiante')->on('estudiantes')->unsigned(false);
            $table->foreign('idCurso')->references('idCurso')->on('cursos')->unsigned(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

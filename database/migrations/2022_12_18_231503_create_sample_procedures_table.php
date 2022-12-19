<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_procedures', function (Blueprint $table) {
            $table->id();
            // Se agrega una columna "name" de tipo string
            $table->string('name');

            // Se agrega una columna "pdf_all" de tipo boolean para saber si solo deberia ser 1 PDF que consodila todos los examenes
            $table->boolean('pdf_all_exam');

            
            $table->timestamps();
            // Se agrega una columna "deleted_at" de tipo timestamp que se utilizará para marcar registros eliminados de forma lógica
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_procedures');
    }
}

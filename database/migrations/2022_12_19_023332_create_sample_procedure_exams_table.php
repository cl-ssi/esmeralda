<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleProcedureExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_procedure_exams', function (Blueprint $table) {
            $table->id();
            /**
             * Columna "exam_id" de tipo entero con clave externa. Se utilizará para almacenar el ID del examen al que pertenece el procedimiento
             */
            $table->foreignId('procedure_id')->nullable()->constrained('sample_procedures');
            $table->foreignId('exam_id')->nullable()->constrained('exam_types');
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
        Schema::dropIfExists('sample_procedure_exams');
    }
}

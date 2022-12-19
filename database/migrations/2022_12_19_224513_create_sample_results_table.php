<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_results', function (Blueprint $table) {
            $table->id();
            /**
             * Columna "sample_id" de tipo entero con clave externa. Se utilizará para almacenar el ID de la muestra al que pertenece el resultado
             */
            $table->foreignId('sample_id')->nullable()->constrained('samples');

            /**
             * Columna "sample_id" de tipo entero con clave externa. Se utilizará para almacenar el ID de la muestra al que pertenece el resultado
             */
            $table->foreignId('exam_id')->nullable()->constrained('exam_types');
            /**
             * Columna "exam_name" de tipo cadena. Se utilizará para almacenar el tipo de examen realizado para obtener el resultado.
             */
            $table->string('exam_name')->nullable();
            /**
             * Columna "result" de tipo cadena. Se utilizará para almacenar el resultado del examen.
             */
            $table->string('result')->nullable();
            /**
             * Columna "result_at" de tipo fecha y hora. Se utilizará para almacenar la fecha y hora en la que se obtuvo el resultado.
             */
            $table->datetime('result_at')->nullable();
            /**
             * Columna "pdf" de tipo cadena. Se utilizará para almacenar la ruta del archivo PDF con el resultado del examen.
             */
            $table->string('pdf')->nullable();

            /**
             * Columna "reception_at" de tipo fecha y hora. Se utilizará para almacenar la fecha y hora en la que se recepciono la muestra
             */
            $table->datetime('reception_at')->nullable();
            
            /**
             * Columna "created_at" de tipo fecha y hora. Se utilizará para almacenar la fecha y hora en la que se creó el registro en la base de datos.
             */
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
        Schema::dropIfExists('sample_results');
    }
}

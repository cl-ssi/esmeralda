<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            /**
             * Columna "date" de tipo fecha. Se utilizará para almacenar la fecha de la muestra.
             */
            $table->datetime('sample_at')->nullable();

            /**
             * Columna "type" de tipo cadena. Se utilizará para almacenar el tipo de muestra.
             */
            $table->string('sample_type')->nullable();

            /**
             * Columna "establishment_id" de tipo entero con clave externa. Se utilizará para almacenar el ID del establecimiento al que pertenece la muestra.
             */
            $table->foreignId('establishment_id')->nullable()->constrained('establishments');

            /**
             * Columna "user_id" de tipo cadena con clave externa. Se utilizará para almacenar el ID del usuario que creó la muestra.
             */
            $table->string('user_id')->nullable()->constrained('users');

            /**
             * Columna "patient_id" de tipo cadena con clave externa. Se utilizará para almacenar el ID del paciente al que pertenece la muestra.
             */
            $table->string('patient_id')->nullable()->constrained('patients');


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
        Schema::dropIfExists('samples');
    }
}

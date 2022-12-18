<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Se crea una nueva tabla en la base de datos llamada "exam_types"
        Schema::create('exam_types', function (Blueprint $table) {
            // Se agrega una columna "id" que será la clave primaria de la tabla y se autogenerará de forma incremental
            $table->id();
            // Se agrega una columna "name" de tipo string
            $table->string('name');
            // Se agrega una columna "values" de tipo string
            $table->json('values');
            // Se agrega una columna "unit" de tipo string, que puede ser nullable
            $table->string('unit')->nullable();
            // Se agrega una columna "reference" de tipo string, que puede ser nullable
            $table->string('reference_range')->nullable();
            // Se agrega dos columnas de tipo timestamp: "created_at" y "updated_at" que se actualizarán automáticamente
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
        Schema::dropIfExists('exam_types');
    }
}

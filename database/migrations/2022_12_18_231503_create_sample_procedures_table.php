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

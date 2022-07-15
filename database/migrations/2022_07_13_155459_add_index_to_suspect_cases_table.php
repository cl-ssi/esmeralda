<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToSuspectCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suspect_cases', function (Blueprint $table) {
            //
            $table->index('pcr_sars_cov_2');
            $table->index(['pcr_sars_cov_2', 'sample_at']);
            $table->index(['pcr_sars_cov_2', 'sample_at','establishment_id'], 'pcr_establishment');

            //Indice para examenes de laboratorio
            $table->index(['pcr_sars_cov_2', 'laboratory_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suspect_cases', function (Blueprint $table) {
            //
            $table->dropIndex('suspect_cases_pcr_sars_cov_2_index');
            $table->dropIndex('suspect_cases_pcr_sars_cov_2_sample_at_index');
            $table->dropIndex('pcr_establishment');

            //Indice para el listado de examenes de laboratorio
            $table->dropIndex('suspect_cases_pcr_sars_cov_2_laboratory_id_index');
        });
    }
}

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
            $table->index(['pcr_sars_cov_2', 'pcr_sars_cov_2_at']);
            $table->index(['pcr_sars_cov_2', 'pcr_sars_cov_2_at','establishment_id'], 'pcr_establishment');
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
            $table->dropIndex('suspect_cases_pcr_sars_cov_2_pcr_sars_cov_2_at_index');
            $table->dropIndex('pcr_establishment');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeToSolicitationsTableForRequirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('requirements', function($table){
            $table->dropForeign('requirements_solicitation_id_foreign');
            $table->foreign('solicitation_id')->references('id')->on('solicitations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('requirements', function($table){
            $table->dropForeign('requirements_solicitation_id_foreign');
            $table->foreign('solicitation_id')->references('id')->on('solicitations');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('solicitations', function($table){
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->integer('requirement_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->date('date_of');
            $table->string('position');
            $table->string('company');
            $table->string('compensation');
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
        Schema::drop('solicitations');
    }
}

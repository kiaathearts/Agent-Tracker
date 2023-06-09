<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAgenttypeidColumnToAgenttypeIdInAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('agents', function($table){
            $table->renameColumn('agentTypeId', 'agenttype_id');
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
        Schema::table('agents', function($table){
            $table->renameColumn('agenttype_id', 'agentTypeId');
        });
    }
}

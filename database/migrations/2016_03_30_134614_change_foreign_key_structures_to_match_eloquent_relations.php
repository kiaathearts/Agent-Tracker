<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignKeyStructuresToMatchEloquentRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Change agentTypeId to be compatible with eloquent relationships.
        Schema::table('agents', function($table){
            $table->renameColumn('agentTypeId', 'agenttype_id');
        });
        //Change agentId to be compatible with eloquent relationships.
        Schema::table('notes', function($table){
            //Note: even if he column name is camel case, foreign key is named in all lower
            $table->dropForeign('notes_agentid_foreign');
            $table->renameColumn('agentId', 'agent_id');
            $table->foreign('agent_id')->references('id')->on('agents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Change agentTypeId to be compatible with eloquent relationships.
        Schema::table('agents', function($table){
            $table->renameColumn('agenttype_id', 'agentTypeId');
        });
        //Change agentId to be compatible with eloquent relationships.
        Schema::table('notes', function($table){
            $table->renameColumn('agent_id', 'agentId');
        });
    }
}

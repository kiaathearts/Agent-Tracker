<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToMessageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('message_logs', function($table){
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('message_id')->references('id')->on('messages');
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
        Schema::table('message_logs', function($table){
            $table->dropForeign('message_logs_message_id_foreign');
            $table->dropForeign('message_logs_agent_id_foreign');
        });
    }
}

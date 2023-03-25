<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateFieldsToNewTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('solicitations', function(){
            $table->timestamps();
        });
        Schema::table('skilltypes', function(){
            $table->timestamps();
        });
        Schema::table('requirements', function(){
            $table->timestamps();
        });
        Schema::table('terms', function(){
            $table->timestamps();
        });
        Schema::table('skills', function(){
            $table->timestamps();
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
        Schema::table('solicitations', function(){
            $table->dropColumn(array('created_at', 'updated_at'));
        });
        Schema::table('skilltypes', function(){
            $table->dropColumn(array('created_at', 'updated_at'));
        });
        Schema::table('requirements', function(){
            $table->dropColumn(array('created_at', 'updated_at'));
        });
        Schema::table('terms', function(){
            $table->dropColumn(array('created_at', 'updated_at'));
        });
        Schema::table('skills', function(){
            $table->dropColumn(array('created_at', 'updated_at'));
        });
    }
}

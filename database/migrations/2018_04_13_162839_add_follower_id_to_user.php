<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFollowerIdToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followers', function($table){
            $table->integer('user_id');
        });

        Schema::table('followers', function($table){
            $table->integer('follower_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followers', function($table){
            $table->dropColumn('user_id');
        });

        Schema::table('followers', function($table){
            $table->dropColumn('follower_id');
        });
    }
}

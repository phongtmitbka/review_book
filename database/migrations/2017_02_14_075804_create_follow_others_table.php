<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others_follows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_follow_id')->unsigned();
            $table->integer('user_followed_id')->unsigned();
            $table->foreign('user_follow_id')->references('id')->on('users');
            $table->foreign('user_followed_id')->references('id')->on('users');
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
        Schema::drop('others_follows');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_one');
            $table->foreign('user_one')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_two');
            $table->foreign('user_two')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'declined', 'friends'])->default('pending');
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
        Schema::dropIfExists('friend_list');
    }
}

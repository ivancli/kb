<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('title', array("mr", "mrs", "ms", "mx", "miss", "madam", "dr", "prof"))->nullable();
            $table->string('description')->nullable();
            $table->date("dob")->nullable();
            $table->enum('gender', array("male", "female", "other"))->nullable();
            $table->string('phone')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE user_info ADD profile_pic MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_info');
    }
}

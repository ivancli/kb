<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamsUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chams_user_info', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('staff_id')->nullable();
            $table->string('telephone')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->string('staff_cost_centre')->nullable();
            $table->string('salesforce_id')->nullable();
            $table->string('client_title')->nullable();
            $table->string('client_business')->nullable();
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
        Schema::drop('chams_user_info');
    }
}

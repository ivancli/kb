<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamsEventTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chams_event_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_category_id')->unsigned();
            $table->foreign('event_category_id')->references('id')->on('chams_event_categories')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chams_event_types');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamsAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chams_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_type_id')->unsigned();
            $table->foreign('asset_type_id')->references('id')->on('chams_asset_types')->onDelete('cascade');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('chams_events')->onDelete('cascade');
            $table->integer('business_unit_id')->unsigned();
            $table->foreign('business_unit_id')->references('id')->on('chams_business_units')->onDelete('cascade');
            $table->string('name');
            $table->integer('asset_number');
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->enum('returned', array('yes', 'no'))->default('no');
            $table->enum('fulfilled', array('yes', 'no'))->default('yes');
            $table->integer('given_out_time')->nullable();
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
        Schema::drop('chams_assets');
    }
}

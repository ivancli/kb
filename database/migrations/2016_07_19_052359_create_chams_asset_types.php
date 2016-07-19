<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamsAssetTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chams_asset_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('persons_allowed')->default(1);
            $table->enum('guest_name_required', array("yes", "no"))->default("no");
            $table->enum('booking_form_type', array("list", "calendar"))->default("list");
            $table->decimal('meal_cost', 5, 2)->nullable();
            $table->decimal('meal_recovery', 5, 2)->nullable();
            $table->decimal('non_meal_cost', 5, 2)->nullable();
            $table->enum('returnable', array('yes', 'no'))->default('no');
            $table->integer('return_days')->nullable();
            $table->enum('is_private', array('yes', 'no'))->default('no');
            $table->enum('box_office', array('yes', 'no'))->default('no');
            $table->enum('email_confirm', array('yes', 'no'))->default('no');
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
        Schema::drop('chams_asset_types');
    }
}

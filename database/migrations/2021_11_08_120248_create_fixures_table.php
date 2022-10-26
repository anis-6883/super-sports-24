<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixures', function (Blueprint $table) {
            $table->id();
            $table->integer('sports_type_id');
            $table->string('series_name');
            $table->string('team_one_name');
            $table->string('image_one_type')->nullable();
            $table->string('image_two_type')->nullable();
            $table->string('image_one_value')->nullable();
            $table->string('image_two_value')->nullable();
            $table->string('date_time');
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
        Schema::dropIfExists('fixures');
    }
}

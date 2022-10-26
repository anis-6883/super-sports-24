<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightStreamingSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('highlight_streaming_sources', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('highlight_id');
            $table->string('stream_title');
            $table->string('stream_type');
            $table->string('resulation', 20);
            $table->string('stream_url');
            $table->string('stream_key')->nullable();
            $table->longText('headers')->nullable();
            $table->longText('block_country')->nullable();
            $table->integer('is_block_them');
            
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
        Schema::dropIfExists('highlight_streaming_sources');
    }
}

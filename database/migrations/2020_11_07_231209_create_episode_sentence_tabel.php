<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeSentenceTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_sentence', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('episode_id');
            $table->uuid('sentence_id');
            $table->uuid('speaker_id')->nullable();
            $table->timestamps();

            $table->foreign('episode_id')->references('id')->on('episodes');
            $table->foreign('sentence_id')->references('id')->on('sentences');
            $table->foreign('speaker_id')->references('id')->on('speakers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode_sentence');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_quote', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('translation_id');
            $table->foreign('translation_id')->references('id')->on('translation');
            $table->string('value', 100);
            $table->text('leipzig_glossing');
            $table->string('audio', 150);
            $table->uuid('episode_id');
            $table->foreign('episode_id')->references('id')->on('episode');
            $table->string('speaker', 50);
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
        Schema::dropIfExists('episode_quote');
    }
}

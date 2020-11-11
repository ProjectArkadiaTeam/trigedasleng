<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('season_id');
            $table->foreign('season_id')->references('id')->on('season');
            $table->string('name', 100);
            $table->integer('season_number');
            $table->integer('series_number');
            $table->dateTime('aired_at'); // UTC
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
        Schema::dropIfExists('episode');
    }
}

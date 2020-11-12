<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('sentences', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('dictionary_id');
            $table->uuid('source_id');
            $table->string('value');
            $table->string('english');
            $table->string('etymology');
            $table->string('leipzig_glossing');
            $table->string('audio');
            $table->timestamps();

            $table->foreign('dictionary_id')->references('id')->on('dictionaries');
            $table->foreign('source_id')->references('id')->on('sources');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentences');
    }
}

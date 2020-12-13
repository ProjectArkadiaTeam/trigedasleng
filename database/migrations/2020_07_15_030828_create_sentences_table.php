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
            $table->uuid('source_id')->nullable();
            $table->text('value');
            $table->text('english');
            $table->text('etymology')->nullable();
            $table->text('leipzig_glossing')->nullable();
            $table->text('audio')->nullable();
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

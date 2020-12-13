<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('word_source_id');
            $table->uuid('word_target_id');
            $table->uuid('source_id')->nullable();
            $table->text('etymology')->default('unknown');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('word_source_id')->references('id')->on('words');
            $table->foreign('word_target_id')->references('id')->on('words');
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
        Schema::dropIfExists('translations');
    }
}

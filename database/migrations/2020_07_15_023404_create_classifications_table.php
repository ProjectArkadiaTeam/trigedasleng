<?php

use App\Classification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('value');
            $table->timestamps();
        });

        // Create defaults
        (new Classification(['value'  => 'none',]))->save();
        (new Classification(['value'  => 'noun',]))->save();
        (new Classification(['value'  => 'pronoun',]))->save();
        (new Classification(['value'  => 'verb',]))->save();
        (new Classification(['value'  => 'adjective',]))->save();
        (new Classification(['value'  => 'adverb',]))->save();
        (new Classification(['value'  => 'conjunction',]))->save();
        (new Classification(['value'  => 'preposition',]))->save();
        (new Classification(['value'  => 'interjection',]))->save();
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifications');
    }
}

<?php

use App\Dictionary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('value');
            $table->timestamps();
        });

        // Create default dictionaries
        (new Dictionary(['value'  => 'Trigedasleng',]))->save();
        (new Dictionary(['value'  => 'Slakgedasleng',]))->save();
        (new Dictionary(['value'  => 'Noncanon Trigedasleng',]))->save();
        (new Dictionary(['value'  => 'English',]))->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('dictionaries');
        Schema::enableForeignKeyConstraints();
    }
}

<?php

use App\Season;
use App\Series;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('series_id');
            $table->integer('value');
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series');
        });

        // Create defaults
        (new Season(['value'  => '1', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Season(['value'  => '2', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Season(['value'  => '3', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Season(['value'  => '4', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Season(['value'  => '5', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Season(['value'  => '6', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Season(['value'  => '7', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}

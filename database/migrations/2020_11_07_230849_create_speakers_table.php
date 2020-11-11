<?php

use App\Series;
use App\Speaker;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('value');
            $table->uuid('series_id');
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series');
        });

        (new Speaker(['value'  => 'Clarke',     'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Octavia',    'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Miller',     'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Lincoln',    'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Madi',       'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Karina',     'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Warrior(s)', 'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Grounder(s)','series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Indra',      'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Gaia',       'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Echo',       'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Crowd',      'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Bellamy',    'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Artigas',    'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Brell',      'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Tarik',      'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Reaper',     'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Penn',       'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Murphey',    'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Nyko',       'series_id' => Series::whereValue('The 100')->value('id')]))->save();
        (new Speaker(['value'  => 'Obika',      'series_id' => Series::whereValue('The 100')->value('id')]))->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('speakers');
    }
}

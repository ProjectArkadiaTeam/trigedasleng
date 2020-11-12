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
            $table->integer('season_number'); // Redundancy to avoid reserved keywords
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series');
        });

        // Retrieve a list of currently available series
        $SeriesList = Series::all();
        $series = [];
        foreach($SeriesList as $show){
            $series[$show->value] = $show->id;
        }

        // Retrieve the seasons that should be imported
        $fileData = file_get_contents(dirname(__DIR__, 2) . '/bin/json/seasons.json');
        $seasons = json_decode($fileData, true);
        $params = [];
        foreach($seasons as $season){
            // Only import seasons that have a matching series
            if(isset($series[ $season['series_name'] ])){
                $params[] = [
                    'series_id' => $series[$season['series_name']],
                    'season_number' => $season['number']
                ];
            }
        }

        // If there are rows to insert, do so
        if(!empty($params)){
            foreach ($params as $season)
            {
                Season::create($season);
            }
        }
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

<?php

use App\Episode;
use App\Season;
use App\Series;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('season_id');
            $table->string('value');
            $table->integer('season_number');
            $table->integer('series_number');
            $table->timestamps();

            $table->foreign('season_id')->references('id')->on('seasons');
        });

        // Retrieve a list of currently available series
        $SeriesList = Series::all();
        $series = [];
        foreach($SeriesList as $show){
            $series[$show->value] = $show->id;
        }

        // Retrieve the episodes that should be imported
        $fileData = file_get_contents(dirname(__DIR__, 2) . '/bin/json/episodes.json');
        $episodes = json_decode($fileData, true);
        $params = [];
        foreach($episodes as $episode){
            // Only import episodes that have a matching series
            if(isset($series[ $episode['series_name'] ])){
                $params[] = [
                    'value' => $episode['episode_name'],
                    'season_id' => Season::whereSeasonNumber($episode['season'])->value('id'),
                    'season_number' => $episode['season_number'],
                    'series_number' => $episode['series_number'],
                ];
            }
        }

        // If there are rows to insert, do so
        if(!empty($params)){
            foreach ($params as $episode)
            {
                Episode::create($episode);
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
        Schema::dropIfExists('episodes');
    }
}

<?php

use App\Episode;
use App\Season;
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

        //Create episodes
        $ec = 1; // Episode Count
        $sc = 1;
        (new Episode(['value'  => 'Pilot',                          'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Earth Skills',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Earth Kills',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Murphy\'s law',                  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Twilight\'s Last Gleaming',      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'His Sister\'s Keeper',           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Contents Under Pressure',        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Day Trip',                       'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Unity Day',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'I Am Become Death',              'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Calm',                       'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'We Are Grounders – Part I',      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'We Are Grounders – Part II',     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc++)->value('id')]))->save();
        (new Episode(['value'  => 'The 48',                         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Inclement Weather',              'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Reapercussions',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Many happy returns',             'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Human Trials',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Fog of War',                     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Long Into An Abyss',             'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Spacewalker',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Remember Me',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Survival of the Fittest',        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Coup de Grace',                  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Rubicon',                        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Resurrection',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Bodyguard of Lie',               'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Blood Must Have Blood: Part 1',  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Blood Must Have Blood: Part 2',  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc++)->value('id')]))->save();
        (new Episode(['value'  => 'Wanheda: Part 1',                'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Wanheda: Part 2',                'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Ye Who Enter Here',              'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Watch The Throne',               'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Hakeldama',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Bitter Harvest',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Thirteen',                       'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Terms And Conditions',           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Stealing Fire',                  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Fallen',                         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Nevermore',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Demons',                         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Join or Die',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Red Sky at Morning',             'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Perverse Instantiation: Part 1', 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Perverse Instantiation: Part 2', 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc++)->value('id')]))->save();
        (new Episode(['value'  => 'Echoes',                         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Heavy Lies the Crown',           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Four Horsemen',              'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'A Lie Guarded',                  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Tinder Box',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'We Will Rise',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Gimme Shelter',                  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'God Complex',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'DNR',                            'season_number' => $sc,    'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Die all, Die Merrily',           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Other Side',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Chosen',                     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Praimfaya',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc++)->value('id')]))->save();
        (new Episode(['value'  => 'Eden',                           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Red Queen',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Sleeping Giants',                'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Pandora\'s Box',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Shifting Sands',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Exit Wounds',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Acceptable Losses',              'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'How We Get to Peace',            'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Sic Semper Tyrannis',            'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Warriors Will',              'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Dark Year',                  'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Damocles – Part One',            'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Damocles – Part Two',            'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc++)->value('id')]))->save();
        (new Episode(['value'  => 'Sanctum',                        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Red Sun Rising',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Children of Gabriel',        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Face Behind the Glass',      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Gospel of Josephine',        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Memento Mori',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Nevermind',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Old Man and the Anomaly',    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'What You Take With You',         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Matryoshka',                     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Ashes to Ashes',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Adjustment Protocol',            'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Blood of Sanctum',           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc++)->value('id')]))->save();
        (new Episode(['value'  => 'From the Ashes',                 'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Garden',                     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'False Gods',                     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Hesperides',                     'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Welcome to Bardo',               'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Nakara',                         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Queen\'s Gambit',            'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Anaconda',                       'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Flock',                      'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'A Little Sacrifice',             'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Etherea',                        'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Stranger',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'Blood Giant',                    'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'A Sort of Homecoming',           'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Dying of the Light',         'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
        (new Episode(['value'  => 'The Last War',                   'season_number' => $sc, 'series_number' => $ec++, 'season_id' => Season::whereValue($sc)->value('id')]))->save();
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

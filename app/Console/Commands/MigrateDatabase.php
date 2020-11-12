<?php

namespace App\Console\Commands;

use App\Classification;
use App\Dictionary;
use App\Sentence;
use App\Translation;
use App\Word;
use App\Source;
use Illuminate\Console\Command;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\EnumeratesValues;

class MigrateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts from the old database into the new one';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function convertWords() {
        $words = DB::table('dict_words');
        $data = $words->get()->toArray();

        foreach ($data as $word) {
            $trig = $word->word;
            $english = explode(',', explode(':', $word->translation)[1]);
            $classification = explode(':', $word->translation)[0];
            $etymology = str_replace('from: ', '', $word->etymology);

            // Find dictionary
            $dictionary = Dictionary::whereValue('Trigedasleng')->value('id');
            if(str_contains($word->filter, 'noncanon')) {
                $dictionary = Dictionary::whereValue('Noncanon Trigedasleng')->value('id');
            }
            if(str_contains($word->filter, 'slakgedasleng')) {
                $dictionary = Dictionary::whereValue('Slakgedasleng')->value('id');
            }

            // Create word in new schema
            $new_word = new Word(['value' => $trig, 'dictionary_id' => $dictionary]);
            $new_word->save();

            // Attach classification
            $new_word->classifications()->attach(Classification::whereValue($classification)->value('id'), ['id' => Str::orderedUuid()]);

            // Create a english word instance for every translation
            foreach ($english as $entry){
                $eng = new Word(['value' => $entry, 'dictionary_id' => Dictionary::whereValue('English')->value('id')]);
                $eng->save();

                $eng->classifications()->attach(Classification::whereValue($classification)->value('id'), ['id' => Str::orderedUuid()]);

                $translation = new Translation(['word_source_id' => $new_word->getKey(), 'word_target_id' => $eng->getKey(), 'etymology' => $etymology, 'is_approved' => true]);
                $translation->save();
            }
        }
    }

    public function convertSentences() {
        $sentences = DB::table('dict_translations');
        $data = $sentences->get()->toArray();

        foreach ($data as $sentence) {
            $trig = $sentence->trigedasleng;
            $english = $sentence->translation;
            $etymology = $sentence->etymology;
            $leipzig = $sentence->leipzig;
            $audio = $sentence->audio;
            $speaker = $sentence->speaker;
            $episode = $sentence->episode;

            $source = null;
            if ($episode != 'other') {
                // Guess source
                $season = str_split($episode)[1];
                $episode_n = 0;
                if (str_split($episode)[2] != '0')
                    $episode_n = str_split($episode)[2] + str_split($episode)[3];
                else
                    $episode_n = str_split($episode)[3];

                $source = \App\Source::whereTitle('Conlang Dialogue: The 100, Episode ' . $season . $episode_n)->value('id');
            }

            // Create new sentence
            $new_sentence = new Sentence(
                [
                    'dictionary_id' => Dictionary::whereValue('Trigedasleng')->value('id'),
                    'source_id' => $source,
                    'value' => $trig,
                    'english' => $english,
                    'etymology' => $etymology,
                    'leipzig_glossing' => $leipzig,
                    'audio' => $audio,
                ]
            );
            $new_sentence->save();

            // Create episode quote
            if($episode != 'other'){
                //$new_episode =
            }
        }
    }

    /**
     * Execute the console command.
     * Very crude way of converting from the old database schema to the new one
     *
     * @return int
     */
    public function handle()
    {

        //$this->convertWords();
        //$this->convertSentences();

        return 0;
    }
}

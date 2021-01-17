<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LegacyController extends Controller
{
    public function search(Request $request){
        if(!$request->has('query') || trim($request->input('query')) === ''){
            return 'A search query is required!';
        }

        $data = [];

        $words = DB::table('dict_words')->where('word', 'LIKE', "%{$request->input('query')}%")
            ->orWhere('translation', 'LIKE', "%{$request->input('query')}%")->get();
        $data['words'] = $words;
        if($words->isNotEmpty()){
            $data['translations'] = $words->toArray();
        }

        $translations = DB::table('dict_translations')->where('trigedasleng', 'LIKE', "%{$request->input('query')}%")
            ->orWhere('translation', 'LIKE', "%{$request->input('query')}%")->get();
        if($translations->isNotEmpty()){
            $data['translations'] = $translations->toArray();
        }

        return response()->json($this->utf8ize($data), 200, array());
    }

    public function dictionary(Request $request){
        $words = DB::table('dict_words');
        if($request->has('filter') && trim($request->input('filter')) !== '' && $request->input('filter') !== 'all'){
            foreach(explode(' ', $request->input('filter')) as $term){
                $words->where('filter', 'RLIKE', "[[:<:]]{$term}[[:>:]]");
            }
        }
        $words = $words->get();
        $data = [];

        if($words->isNotEmpty()){
            $data = $words->toArray();
        }

        return response()->json($this->utf8ize($data), 200, array());
    }

    public function translations(){
        $translations = DB::table('dict_translations');
        $data = $translations->get()->toArray();

        return response()->json($this->utf8ize($data), 200, array());
    }

    public function wordLookup(Request $request){
        if(!$request->has('query') || trim($request->input('query')) === ''){
            return 'A search query is required!';
        }

        $word = $request->input('query');
        $data = [];

        // Get word info
        $wordInfo = DB::select('SELECT * FROM `dict_words` WHERE `word`= ?', [$word]);
        if(!isset($wordInfo)){
            return 'Word(s) not found!';
        }
        $data['word'] = $wordInfo;

        // Get example translations
        $translationList = DB::select("SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE ?) LIMIT 3", ["%{$word}%"]);
        $data['examples'] = $translationList;

        // Get sources
//        $citation = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$wordInfo->citations]);
//        $data['source'] = $citation;

        return response()->json($this->utf8ize($data), 200, array());
    }

    public function recent(Request $request) {
        $limit = $request->input('limit') != "" ? $request->input('limit') : 10;
        $recentList = DB::select("SELECT * FROM `dict_words` ORDER BY id DESC LIMIT ?", [$limit]);

        return response()->json($this->utf8ize($recentList), 200, array());
    }

    public function random(Request $request) {
        $data['word'] = DB::selectOne("SELECT * FROM `dict_words` ORDER BY RAND() LIMIT 1");
        $data['translation'] = DB::selectOne("SELECT * FROM `dict_translations` ORDER BY RAND() LIMIT 1");

        return response()->json($this->utf8ize($data), 200, array());

    }

    public function sources(){
        $sources = DB::table('dict_sources');
        $data = $sources->get()->toArray();

        return response()->json($this->utf8ize($data), 200, array());
    }

    private function utf8ize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->utf8ize($value);
            }
        } else if (is_string ($data)) {
            return utf8_encode($data);
        }
        return $data;
    }
}

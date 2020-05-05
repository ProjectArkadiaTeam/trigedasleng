<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index(Request $request){
        return view('index', [
            'randomWord' => DB::selectOne('SELECT * FROM `dict_words` ORDER BY RAND() LIMIT 1'),
            'randomTranslation' => DB::selectOne('SELECT * FROM `dict_translations` ORDER BY RAND() LIMIT 1'),
            'recentWordList' => DB::select('SELECT * FROM `dict_words` ORDER BY id DESC LIMIT 10'),
        ]);
    }

    public function word(Request $request, $word){
        $wordInfo = DB::selectOne('SELECT * FROM `dict_words` WHERE `word`= ?', [$word]);
        return view('word', [
            'word' => $wordInfo,
            'translationList' => DB::select("SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE ?) LIMIT 3", ["%{$word}%"]),
            'citation' => DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$wordInfo->citations]),
        ]);
    }
}

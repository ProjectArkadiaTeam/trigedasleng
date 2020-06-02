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

        $translations = DB::table('dict_translations')->where('trigedasleng', 'LIKE', "%{$request->input('query')}%")
            ->orWhere('translation', 'LIKE', "%{$request->input('query')}%")->get();
        $data['translations'] = $translations->toArray();

        return response()->json($this->utf8ize($data), 200, array(), JSON_PRETTY_PRINT);
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

        return response()->json($this->utf8ize($data), 200, array(), JSON_PRETTY_PRINT);
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

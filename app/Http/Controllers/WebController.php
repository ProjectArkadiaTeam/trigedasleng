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

    public function wordLookup(Request $request, $word){
        $wordInfo = DB::selectOne('SELECT * FROM `dict_words` WHERE `word`= ?', [$word]);
        if(!isset($wordInfo)){
            return response(view('word.lookup', [
                'word' => $word,
            ]), 404);
        }
        $translationList = DB::select("SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE ?) LIMIT 3", ["%{$word}%"]);
        $citation = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$wordInfo->citations]);
        return view('word.lookup', [
            'word' => $wordInfo,
            'translationList' => $translationList,
            'citation' => $citation,
        ]);
    }

    public function wordEdit(Request $request, $word){
        if((int) session('admin') !== 1){
            return redirect(route('word.lookup', $word));
        }
        $wordInfo = DB::selectOne('SELECT * FROM `dict_words` WHERE `word`= ?', [$word]);
        $translationList = DB::select("SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE ?) LIMIT 3", ["%{$word}%"]);
        $citation = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$wordInfo->citations]);
        return view('word.edit', [
            'word' => $wordInfo,
            'translationList' => $translationList,
            'citation' => $citation,
        ]);
    }

    public function wordEditSubmit(Request $request, $word){
        if((int) session('admin') !== 1){
            return redirect(route('word.lookup', $word));
        }

        $update = DB::table('dict_words')->where('id', '=', $request->id)->update([
            'word' => $request->trig,
            'translation' => $request->translation,
            'etymology' => $request->etymology,
            'citations' => $request->source,
            'filter' => $request->dictionary,
        ]);
        $wordInfo = DB::selectOne('SELECT * FROM `dict_words` WHERE `word`= ?', [$request->trig]);
        $translationList = DB::select("SELECT * FROM `dict_translations` WHERE (`trigedasleng` LIKE ?) LIMIT 3", ["%{$word}%"]);
        $citation = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$wordInfo->citations]);
        return view('word.edit', [
            'word' => $wordInfo,
            'translationList' => $translationList,
            'citation' => $citation,
            'status'=> 'Updated word successfully!',
        ]);
    }

    public function translationLookup(Request $request, $id){
        $translationInfo = DB::selectOne("SELECT * FROM `dict_translations` WHERE `id`=?", [$id]);
        if(!isset($translationInfo)){
            return response(view('translation.lookup', [
                'translation' => $id,
            ]), 404);
        }
        $citation = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$translationInfo->source]);
        return view('translation.lookup', [
            'translation' => $translationInfo,
            'citation' => $citation,
        ]);
    }

    public function translationEdit(Request $request, $id){
        if((int) session('admin') !== 1){
            return redirect(route('translation.lookup', $id));
        }
        $translationInfo = DB::selectOne('SELECT * FROM `dict_translations` WHERE `id`= ?', [$id]);
        $source = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$translationInfo->source]);
        return view('translation.edit', [
            'translation' => $translationInfo,
            'source' => $source,
        ]);
    }

    public function translationEditSubmit(Request $request, $id){
        if((int) session('admin') !== 1){
            return redirect(route('translation.lookup', $id));
        }

        $update = DB::table('dict_translations')->where('id', '=', $request->id)->update([
            'trigedasleng' => $request->trig,
            'translation' => $request->translation,
            'etymology' => $request->etymology,
            'leipzig' => $request->leipzig,
            'episode' => isset($request->episode) ? $request->episode : 'other',
            'audio' => $request->audio,
            'speaker' => isset($request->speaker) ? $request->speaker : '',
            'source' => $request->source,
        ]);
        $translationInfo = DB::selectOne('SELECT * FROM `dict_translations` WHERE `id`= ?', [$request->id]);
        $source = DB::selectOne('SELECT * FROM `dict_sources` WHERE `id`=?', [$translationInfo->source]);
        return view('translation.edit', [
            'translation' => $translationInfo,
            'source' => $source,
            'status'=> 'Updated translation successfully!',
        ]);
    }

    public function dictionaryLookup(Request $request, $dictionary = null){
        if($request->has('filter')){
            return redirect(route('dictionary.lookup', $request->query('filter')), 302);
        }
        $words = DB::table('dict_words');
        if(isset($dictionary)){
            $words->where('filter', 'RLIKE', "[[:<:]]{$dictionary}[[:>:]]");
        }
        $words = $words->orderBy('word')->get();
        if($words->isEmpty()){
            return response(view('dictionary.lookup', [
                'dictionary' => $dictionary,
            ]), 404);
        }
        return view('dictionary.lookup', [
            'words' => $words,
            'dictionary' => $dictionary,
        ]);
    }

    public function sources(Request $request){
        $sources = DB::table('dict_sources')->get();
        return view('sources', [
            'sources' => $sources,
        ]);
    }

    public function translations(Request $request){
        $translations = DB::table('dict_translations')->get();
        $translationList = [];
        foreach($translations as $translation){
            $translationList[$translation->episode][] = $translation;
        }
        unset($translations);
        $episodeList = [
            "0201" => "S2E01: The 48",
            "0202" => "S2E02: Inclement Weather",
            "0203" => "S2E03: Reapercussions",
            "0204" => "S2E04: Many happy returns",
            "0205" => "S2E05: Human Trials",
            "0206" => "S2E06: Fog of War",
            "0207" => "S2E07: Long Into An Abyss",
            "0208" => "S2E08: Spacewalker",
            "0209" => "S2E09: Remember Me",
            "0210" => "S2E10: Survival of the Fittest",
            "0211" => "S2E11: Coup de Grace",
            "0212" => "S2E12: Rubicon",
            "0213" => "S2E13: Resurrection",
            "0214" => "S2E14: Bodyguard of Lies",
            "0215" => "S2E15: Blood Must Have Blood: Part 1",
            "0216" => "S2E16: Blood Must Have Blood: Part 2",
            "0301" => "S3E01: Wanheda: Part 1",
            "0302" => "S3E02: Wanheda: Part 2",
            "0303" => "S3E03: Ye Who Enter Here",
            "0304" => "S3E04: Watch The Throne",
            "0305" => "S3E05: Hakeldama",
            "0306" => "S3E06: Bitter Harvest",
            "0307" => "S3E07: Thirteen",
            "0308" => "S3E08: Terms And Conditions",
            "0309" => "S3E09: Stealing Fire",
            "0310" => "S3E10: Fallen",
            "0311" => "S3E11: Nevermore",
            "0312" => "S3E12: Demons",
            "0313" => "S3E13: Join or Die",
            "0314" => "S3E14: Red Sky at Morning",
            "0315" => "S3E15: Perverse Instantiation: Part 1",
            "0316" => "S3E16: Perverse Instantiation: Part 2",
            "0401" => "S4E01: Echoes",
            "0402" => "S4E02: Heavy Lies the Crown",
            "0403" => "S4E03: The Four Horsemen",
            "0404" => "S4E04: A Lie Guarded",
            "0405" => "S4E05: The Tinder Box",
            "0406" => "S4E06: We Will Rise",
            "0407" => "S4E07: Gimme Shelter",
            "0408" => "S4E08: God Complex",
            "0409" => "S4E09: DNR",
            "0410" => "S4E10: Die all, Die Merrily",
            "0411" => "S4E11: The Other Side",
            "0412" => "S4E12: The Chosen",
            "0413" => "S4E13: Praimfaya",
            "0501" => "S5E01: Eden",
            "0502" => "S5E02: Red Queen",
            "0503" => "S5E03: Sleeping Giants",
            "0504" => "S5E04: Pandora's Box",
            "0505" => "S5E05: Shifting Sands",
            "0506" => "S5E06: Exit Wounds",
            "0507" => "S5E07: Acceptable Losses",
            "0508" => "S5E08: How We Get to Peace",
            "0509" => "S5E09: Sic Semper Tyrannis",
            "0510" => "S5E10: The Warriors Will",
            "0511" => "S5E11: The Dark Year",
            "0512" => "S5E12: Damocles – Part One",
            "0513" => "S5E13: Damocles – Part Two",
            "0601" => "S6E01: Sanctum",
            "0602" => "S6E02: Red Sun Rising",
            "0603" => "S6E03: The Children of Gabriel",
            "0604" => "S6E04: The Face Behind the Glass",
            "0605" => "S6E05: The Gospel of Josephine",
            "0606" => "S6E06: Memento Mori",
            "0607" => "S6E07: Nevermind",
            "0608" => "S6E08: The Old Man and the Anomaly",
            "0609" => "S6E09: What You Take With You",
            "0610" => "S6E10: Matryoshka",
            "0611" => "S6E11: Ashes to Ashes",
            "0612" => "S6E12: Adjustment Protocol",
            "0613" => "S6E13: The Blood of Sanctum",
            "0701" => "S7E01: From the Ashes",
            "0702" => "S7E02: The Garden",
            "0703" => "S7E03: False Gods",
            "0704" => "S7E04: Hesperides",
            "0705" => "S7E05: Welcome to Bardo",
            "0706" => "S7E06: Nakara",
            "0707" => "S7E07: The Queen's Gambit",
            "0708" => "S7E08: Anaconda",
            "0709" => "S7E09: The Flock",
            "0710" => "S7E10: ",
            "0711" => "S7E11: ",
            "0712" => "S7E12: ",
            "0713" => "S7E13: ",
            "0714" => "S7E14: ",
            "0715" => "S7E15: ",
            "0716" => "S7E16: ",
            "other" => "Other Translations"
        ];
        return view('translations', [
            'episodeList' => $episodeList,
            'translationList' => $translationList,
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $users = DB::table('dict_users')->select(['password', 'username', 'admin'])->where('username', '=', $request->username)->get();
        if($users->isNotEmpty() && password_verify($request->password, $users[0]->password)) {
            $_SESSION["username"] = $users[0]->username;
            $_SESSION["admin"] = $users[0]->admin;
            session([
                'username' => $users[0]->username,
                'admin' => $users[0]->admin,
            ]);
            return 'Success';
        }
        return 'Incorrect password or username!';
    }

    public function signup(Request $request){
        if(session('username') !== null){
            return redirect(route('home'))->send();
        }
        return view('signup', []);
    }

    public function signupSubmit(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);
        $users = DB::table('dict_users')->select('username')->where('username', '=', $request->username)->get();
        if($users->isEmpty()){
            $password_hashed = password_hash($request->password, PASSWORD_DEFAULT);
            DB::table('dict_users')->insert([
                'username' => $request->username,
                'password' => $password_hashed,
                'email' => $request->email,
                'signup_date' => DB::raw('NOW()'),
            ]);
            return 'Success';
        }

        return 'Username already exists :(';
    }

    public function signout(Request $request){
        $request->session()->flush();
        return 'Success';
    }

    public function addWord(Request $request){
        if((int) session('admin') !== 1){
            return redirect(route('home'));
        }
        return view('admin.addword', []);
    }

    public function addWordSubmit(Request $request){
        if((int) session('admin') !== 1){
            return redirect(route('home'));
        }

        $request->validate([
            'trig' => 'required',
            'class' => 'required',
            'translation' => 'required',
            'etymology' => 'required',
            'dictionary' => 'required',
        ]);

        // Add slaksleng to noncanon as well
        $dictionary = $request->dictionary;
        if($dictionary === "slakgedasleng") {
            $dictionary .= " noncanon";
        }

        $translation = $request->class . ": " . $request->translation;
        $etymology = "from: " . $request->etymology;

        DB::table('dict_words')->insert([
            'word' => $request->trig,
            'translation' => $translation,
            'etymology' => $etymology,
            'citations' => $request->has('source') ? $request->source : '',
            'filter' => $dictionary,
            'link' => ''
        ]);

        return view('admin.addword', [
            'status' => 'New Word Inserted Successfully',
        ]);
    }

    public function addTranslation(Request $request){
        if((int) session('admin') !== 1){
            return redirect(route('home'));
        }
        return view('admin.addtranslation', []);
    }

    public function addTranslationSubmit(Request $request){
        if((int) session('admin') !== 1){
            return redirect(route('home'));
        }
        $request->validate([
            'trig' => 'required',
            'translation' => 'required',
            'etymology' => 'required',
            'leipzig' => 'required',
            'speaker' => 'required',
        ]);

        DB::table('dict_translations')->insert([
            'trigedasleng' => $request->trig,
            'translation' => $request->translation,
            'etymology' => $request->etymology,
            'leipzig' => $request->leipzig,
            'episode' => $request->has('episode') && isset($request->episode) ? $request->episode : 'other',
            'speaker' => $request->speaker,
            'audio' => $request->has('audio') && isset($request->audio) ? $request->audio : '',
            'source' => $request->has('source') && isset($request->source) ? $request->source : '',
        ]);

        return view('admin.addtranslation', [
            'status' => 'New Translation Inserted Successfully',
        ]);
    }

    public function search(Request $request){
        $wordsList = [];
        $translationsList = [];
        if(isset($request->q) && trim($request->q) !== ''){
            $wordsList = DB::table('dict_words')->where('word', 'LIKE', "%{$request->q}%")
                ->orWhere('translation', 'LIKE', "%{$request->q}%")->get();
            $translationsList = DB::table('dict_translations')->where('trigedasleng', 'LIKE', "%{$request->q}%")
                ->orWhere('translation', 'LIKE', "%{$request->q}%")->get();
        }
        return view('search', [
            'keyword' => $request->q,
            'words' => $wordsList,
            'translations' => $translationsList,
        ]);
    }

    public function liveSearch(Request $request){
        $wordsList = [];
        $translationsList = [];
        if(isset($request->q) && trim($request->q) !== ''){
            $wordsList = DB::table('dict_words')->where('word', 'LIKE', "%{$request->q}%")
                ->orWhere('translation', 'LIKE', "%{$request->q}%")->limit(10)->get();
            $translationsList = DB::table('dict_translations')->where('trigedasleng', 'LIKE', "%{$request->q}%")
                ->orWhere('translation', 'LIKE', "%{$request->q}%")->limit(10)->get();
        }
        return view('live-search', [
            'keyword' => $request->q,
            'words' => $wordsList,
            'translations' => $translationsList,
        ]);
    }
}

@extends('layouts.default.app')

@section('title', 'Home')

@section('content')
    <div id="inner">
        <div class="home">
            <div class="column side">
                <h3>Recently Added</h3>
                <ul>
                    @foreach($recentWordList as $recentWord)
                        <li><a href="{{ route('word.lookup', [$recentWord->word]) }}">{{ $recentWord->word }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="column center">
                <!--About-->
                <div class="daily">
                    <h3>About this website</h3>
                    <p>
                        This website is an attempt at recreating what was Trigedasleng.info after it went dark in december 2018. </p>
                </div>
                <!--Word of the day-->
                <div class="daily">
                    <h3>Random Word</h3>
                    <div class="dictionary entry" style="width:100%">
                        <h4><b><a href="{{ route('word.lookup', [$randomWord->word]) }}">{{ $randomWord->word }}</a></b></h4>
                        <p class="definition">{{ $randomWord->translation }}</p>
                        <p class="etymology">{{ $randomWord->etymology }}</p>
                    </div>
                </div>
                <!--Translation of the day-->
                <div class="daily">
                    <h3>Random Translation</h3>
                    <div class="translations entry unflagged">
                        <table class="gloss">
                            <tbody>
                            <tr class="tgs_text">
                                <td colspan="10"><a href="#">{{ $randomTranslation->trigedasleng }}</a></td>
                            </tr>
                            <tr class="tgs" style="display: table-row;">
                                @foreach(explode(' ', $randomTranslation->trigedasleng) as $word)
                                    <td>{{ $word }}</td>
                                @endforeach
                            </tr>
                            <tr class="ety" style="display: table-row;">
                                @foreach(explode(' ', $randomTranslation->etymology) as $word)
                                    <td>{{ $word }}</td>
                                @endforeach
                            </tr>
                            <tr class="leipzig" style="display: table-row;">
                                @foreach(explode(' ', $randomTranslation->leipzig) as $word)
                                    <td>{{ $word }}</td>
                                @endforeach
                            </tr>
                            <tr class="en_text">
                                <td colspan="10">{{ $randomTranslation->translation }}</td>
                            </tr>
                            </tbody>
                        </table>
                        @if($randomTranslation->audio !== '')
                            <audio controls="" preload="none">
                                <source src="{{ $randomTranslation->audio }}" type="audio/mpeg">
                            </audio>
                        @endif
                    </div>
                </div>
            </div>
            <div class="column side">
                <h3>Resources:</h3>
                <ul id="resources">
                    <li><a href="https://en.wikipedia.org/wiki/Trigedasleng">Trigedasleng on Wikipedia</a></li>
                    <li><a href="https://dedalvs.tumblr.com/tagged/Trigedasleng">Dedalvs Tumblr</a></li>
                    <li><a href="http://dedalvs.com/work/the-100/trigedasleng_master_dialogue.pdf">Transcripts of Trig lines in the show</a></li>
                    <li><a href="http://www.memrise.com/course/957902/trigedasleng/">Memrise course</a></li>
                    <li><a href="https://www.youtube.com/watch?v=JCoxlcHn7SQ&list=PLrk1St_BRZTFrhOYsz2KRS_fZ9ZzTavrq">Slakkru's Learn Trigedasleng videos </a></li>
                    <li><a href="http://slakgedakru.tumblr.com/">Slakgedakru</a></li>
                    <li><a href="https://discord.gg/MFnCpEB">Slakgedakru Discord Server</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

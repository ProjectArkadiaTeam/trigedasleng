@extends('layouts.default.app')

@section('title', isset($citation) ? $word->word : $word)

@section('content')
    @isset($citation)
        <div id="inner">
            <!--        <div class="dictionary entry">-->
            <h1>{{ $word->word }}
                @if(session('admin') && (int) session('admin') === 1)
                    <a style="border-bottom: none;" href="{{ route('word.edit', [$word->word]) }}"><i class="far fa-edit"></i></a>
                @endif
            </h1>
            <p class="definition">{{ $word->translation }}</p>
            <p class="etymology">{{ $word->etymology }}</p>
            <p class="example"><strong>Examples:</strong></p>
            <div class="translations">
                @foreach($translationList as $translation)
                    <div class="entry unflagged">
                        <table class="gloss">
                            <tbody><tr class="tgs_text"><td colspan="10"><a href="#">{{ $translation->trigedasleng }}</a></td></tr>
                            <tr class="tgs" style="display: table-row;">
                                @foreach(explode(' ', $translation->trigedasleng) as $w)
                                    <td>{{ $w }}</td>
                                @endforeach
                            </tr>
                            <tr class="ety" style="display: table-row;">
                                @foreach(explode(' ', $translation->etymology) as $w)
                                    <td>{{ $w }}</td>
                                @endforeach
                            </tr>
                            <tr class="leipzig" style="display: table-row;">
                                @foreach(explode(' ', $translation->leipzig) as $w)
                                    <td>{{ $w }}</td>
                                @endforeach
                            </tr>
                            <tr class="en_text">
                                <td colspan="10">{{ $translation->trigedasleng }}</td>
                            </tr>
                            </tbody>
                        </table>

                        @if($translation->audio !== '')
                            <audio controls="">
                                <source src="/{{ $translation->audio }}" type="audio/mpeg">
                            </audio>
                        @endif
                    </div>
                    </br>
                @endforeach
            </div>
            <p class="notes">{{ $word->note }}</p>
            <h3 class="citations">Sources:</h3>
            @if($citation !== null)
                <ul class="citations">
                    <li><a href="{{ $citation->url }}">{{ $citation->title }}</a></li>
                </ul>
            @else
                <p>None</p>
            @endif
            <div id="output"></div>
        </div>
        <!--<script src="./js/comments.js"></script>-->
    @else
        <div id="inner">
            <h1>{{ $word }} does not exist.</h1>
        </div>
    @endisset
@endsection

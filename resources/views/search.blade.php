@extends('layouts.default.app')

@section('title', "Search $keyword")

@section('content')
    <div id="inner">
        @if($words->isEmpty() && $translations->isEmpty())
            No results found. Try again...
        @else
            @if($words->isNotEmpty())
                <h2>Words matching your search</h2>
                <div class="dictionary">
                    @foreach($words as $word)
                        <div class="entry">
                            <h3><b><a href="{{ route('word.lookup', $word->word) }}">{{ $word->word }}</a></b></h3>
                            <p class="definition">{{ $word->translation }}</p>
                            <p class="etymology">{{ $word->etymology }}</p>
                            @if(stripos($word->filter, 'noncanon') !== false)
                                <i class="noncanon-warning">!!Not a canon word</i>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if($translations->isNotEmpty())
                <h2>Translations matching your search</h2>
                @foreach($translations as $translation)
                    <div class="entry unflagged">
                        <table class="gloss">
                            <tbody><tr class="tgs_text"><td colspan="10"><a href="#">{{ $translation->trigedasleng }}</a></td></tr>
                            <tr class="tgs" style="display: table-row;">
                                @foreach(explode(' ', $translation->trigedasleng) as $word)
                                    <td>{{ $word }}</td>
                                @endforeach
                            </tr>
                            <tr class="ety" style="display: table-row;">
                                @foreach(explode(' ', $translation->etymology) as $word)
                                    <td>{{ $word }}</td>
                                @endforeach
                            </tr>
                            <tr class="leipzig" style="display: table-row;">
                                @foreach(explode(' ', $translation->leipzig) as $word)
                                    <td>{{ $word }}</td>
                                @endforeach
                            </tr>
                            <tr class="en_text">
                                <td colspan="10">{{ $translation->translation }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </br>
                @endforeach
            @endif
        @endif
    </div>
@endsection

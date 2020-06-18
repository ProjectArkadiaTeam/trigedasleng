@extends('layouts.default.app')

@section('title', 'Translations')

@section('content')
    <div id="inner">
        <button type="button" id="toggle">Show/hide filters</button>
        <form id="filter" style="display: block;">
            <section><h3>Show/hide gloss lines</h3>
                <ul id="gloss_filter">
                    <li><input type="checkbox" name="tgs_text" value="tgs_text" onclick="filter('.tgs_text',this)">Hide episode line</li>
                    <li><input type="checkbox" name="tgs" value="tgs" onclick="filter('.tgs',this)" checked="">Hide Trigedasleng gloss</li>
                    <li><input type="checkbox" name="ety" value="ety" onclick="filter('.ety',this)" checked="">Hide etymological gloss</li>
                    <li><input type="checkbox" name="leipzig" value="leipzig" onclick="filter('.leipzig',this)" checked="">Hide Leipzig gloss</li>
                    <li><input type="checkbox" name="en_text" value="en_text" onclick="filter('.en_text',this)">Hide English text</li>
                    <li><input type="checkbox" name="en_text" value="en_text" onclick="filter('.audio',this)">Hide Audio Clip</li>
                </ul>
            </section>

            <section><h3>Hide episodes:</h3>
                <select multiple="multiple" size="10" id="episode-filter">
                    @foreach($episodeList as $number => $name)
                        <option value="{{ $number }}" name="{{ $number }}" onclick="filter('{{ $number }}',this)">{{ $name }}</option>
                    @endforeach
                </select>
            </section>
        </form>
        <div class="translations">
            <h1>Translations</h1>
            @foreach($episodeList as $number => $name)
                <h2 class="{{ $number }}">{{ $name }}</h2>
                @isset($translationList[$number])
                    @foreach($translationList[$number] as $translation)
                        <div class="entry unflagged {{ $number }}">
                            <table class="gloss">
                                <tbody><tr class="tgs_text"><td colspan="10"><a href="/translation/{{$translation->id}}">{{ $translation->trigedasleng }}</a></td></tr>
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
                                    <td colspan="10">{{ $translation->translation }}</td>
                                </tr>
                                </tbody>
                            </table>
                            @if($translation->audio !== '')
                                <audio controls="">
                                    <source src="/{{ $translation->audio }}" type="audio/mpeg">
                                </audio>
                            @endif
                        </div>
                        <div class="line {{ $number }}"></div>
                    @endforeach
                @endisset
            @endforeach

        </div>
    </div>
@endsection

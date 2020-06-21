@extends('layouts.default.app')

@section('title', is_object($translation) ? $translation->trigedasleng : $translation)

@section('content')
    @if(is_object($translation))
        <div id="inner">
            <h1>{{ $translation->trigedasleng}}
                @if(session('admin') && (int) session('admin') === 1)
                    <a style="border-bottom: none;" href="{{ route('translation.edit', [$translation->id]) }}"><i class="far fa-edit"></i></a>
                @endif
            </h1>
            <div class="translation">
                    <div class="entry unflagged">
                        <table class="gloss">
                            <tbody><tr class="tgs_text"><td colspan="10">{{ $translation->trigedasleng }}</td></tr>
                            <tr class="ety" style="display: table-row;">
                                <td>{{ $translation->etymology }}</td>
                            </tr>
                            <tr class="leipzig" style="display: table-row;">
                                <td>{{ $translation->leipzig }}</td>
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
                    </br>
            </div>
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
    @else
        <div id="inner">
            <h1>Translation id: {{ $translation->id }} does not exist.</h1>
        </div>
    @endif
@endsection
